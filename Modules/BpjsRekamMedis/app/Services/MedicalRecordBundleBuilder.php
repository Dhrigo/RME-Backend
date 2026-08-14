<?php

namespace Modules\BpjsRekamMedis\Services;

use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRBackboneElement\FHIRBundle\FHIRBundleEntry;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRCodeableConcept;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRCoding;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRHumanName;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRIdentifier;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRElement\FHIRReference;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRBundle;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRComposition;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRCondition;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRDevice;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRDiagnosticReport;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIREncounter;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRMedicationRequest;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIROrganization;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRPatient;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRPractitioner;
use DCarbone\PHPFHIRGenerated\Versions\R4\Types\FHIRResource\FHIRDomainResource\FHIRProcedure;
use Modules\BpjsRekamMedis\Data\MedicalRecordBundleData;
use Modules\BpjsSmartClaim\Services\SmartClaimIdMappingService;

/**
 * Assembles the FHIR Bundle BPJS's "WS Rekam Medis > Medical Record Format" expects for
 * rekammedis/insert - Bundle(type: document) with entries for Composition, Patient, Encounter,
 * MedicationRequest, Practitioner, Organization, Condition, DiagnosticReport, Procedure, Device.
 * Ported from BPJS\SmartClaim\V1\Rpc\Klaim\KlaimController::kirimAction() / db\klaim\v3\Service::
 * generateBundle() in the original ZF2 source, using dcarbone/php-fhir-generated (R4) instead of
 * the original hand-rolled \fhir\* classes.
 *
 * Every FHIR resource id is obtained via SmartClaimIdMappingService so the same local record
 * always maps to the same FHIR id across submissions (BPJS SmartClaim's ID-correlation scheme).
 */
class MedicalRecordBundleBuilder
{
    public function __construct(private readonly SmartClaimIdMappingService $ids)
    {
    }

    public function build(MedicalRecordBundleData $data): FHIRBundle
    {
        $patientId = $this->ids->idFor('patient', $data->patient['id']);
        $encounterId = $this->ids->idFor('encounter', $data->encounter['id']);
        $practitionerId = $this->ids->idFor('practitioner', $data->practitioner['id']);
        $organizationId = $this->ids->idFor('organization', $data->organization['id']);

        $patient = $this->buildPatient($data->patient, $patientId);
        $encounter = $this->buildEncounter($data->encounter, $encounterId, $patientId);
        $practitioner = $this->buildPractitioner($data->practitioner, $practitionerId);
        $organization = $this->buildOrganization($data->organization, $organizationId);

        $entries = [
            $this->entry($patientId, $patient),
            $this->entry($encounterId, $encounter),
            $this->entry($practitionerId, $practitioner),
            $this->entry($organizationId, $organization),
        ];

        foreach ($data->conditions as $condition) {
            $id = $this->ids->idFor('condition', $condition['id']);
            $entries[] = $this->entry($id, $this->buildCondition($condition, $id, $patientId, $encounterId));
        }

        foreach ($data->diagnosticReports as $report) {
            $id = $this->ids->idFor('diagnostic_report', $report['id']);
            $entries[] = $this->entry($id, $this->buildDiagnosticReport($report, $id, $patientId, $encounterId));
        }

        foreach ($data->procedures as $procedure) {
            $id = $this->ids->idFor('procedure', $procedure['id']);
            $entries[] = $this->entry($id, $this->buildProcedure($procedure, $id, $patientId, $encounterId));
        }

        foreach ($data->medicationRequests as $medicationRequest) {
            $id = $this->ids->idFor('medication_request', $medicationRequest['id']);
            $entries[] = $this->entry($id, $this->buildMedicationRequest($medicationRequest, $id, $patientId, $encounterId));
        }

        foreach ($data->devices as $device) {
            $id = $this->ids->idFor('device', $device['id']);
            $entries[] = $this->entry($id, $this->buildDevice($device, $id));
        }

        $compositionId = $this->ids->idFor('composition', $data->patient['id']);
        array_unshift($entries, $this->entry($compositionId, $this->buildComposition($data, $compositionId, $patientId, $encounterId, $practitionerId)));

        return (new FHIRBundle)
            ->setIdentifier((new FHIRIdentifier)->setSystem('SEP')->setValue($data->noSep))
            ->setType('document')
            ->setEntry(...$entries);
    }

    private function entry(string $id, $resource): FHIRBundleEntry
    {
        return (new FHIRBundleEntry)->setFullUrl("urn:uuid:{$id}")->setResource($resource);
    }

    private function buildComposition(MedicalRecordBundleData $data, string $id, string $patientId, string $encounterId, string $practitionerId): FHIRComposition
    {
        return (new FHIRComposition($id))
            ->setStatus('final')
            ->setTitle($data->compositionTitle)
            ->setDate($data->compositionDate)
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"))
            ->setEncounter((new FHIRReference)->setReference("Encounter/{$encounterId}"))
            ->setAuthor((new FHIRReference)->setReference("Practitioner/{$practitionerId}"));
    }

    private function buildPatient(array $patient, string $id): FHIRPatient
    {
        $fhirPatient = (new FHIRPatient($id))
            ->setIdentifier((new FHIRIdentifier)->setSystem('http://sys-ids.kemkes.go.id/mr')->setValue($patient['mr_number']))
            ->setName((new FHIRHumanName)->setText($patient['name']))
            ->setGender($patient['gender'])
            ->setBirthDate($patient['birth_date']);

        if (! empty($patient['marital_status_code'])) {
            $fhirPatient->setMaritalStatus(
                (new FHIRCodeableConcept)->setCoding(
                    (new FHIRCoding)->setSystem('http://terminology.hl7.org/CodeSystem/v3-MaritalStatus')->setCode($patient['marital_status_code'])
                )
            );
        }

        return $fhirPatient;
    }

    private function buildEncounter(array $encounter, string $id, string $patientId): FHIREncounter
    {
        return (new FHIREncounter($id))
            ->setStatus($encounter['status'])
            ->setClass((new FHIRCoding)->setSystem('http://terminology.hl7.org/CodeSystem/v3-ActCode')->setCode($encounter['class_code']))
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"));
    }

    private function buildPractitioner(array $practitioner, string $id): FHIRPractitioner
    {
        return (new FHIRPractitioner($id))
            ->setIdentifier((new FHIRIdentifier)->setValue($practitioner['identifier']))
            ->setName((new FHIRHumanName)->setText($practitioner['name']));
    }

    private function buildOrganization(array $organization, string $id): FHIROrganization
    {
        return (new FHIROrganization($id))
            ->setIdentifier((new FHIRIdentifier)->setValue($organization['identifier']))
            ->setName($organization['name']);
    }

    private function buildCondition(array $condition, string $id, string $patientId, string $encounterId): FHIRCondition
    {
        return (new FHIRCondition($id))
            ->setCode((new FHIRCodeableConcept)->setCoding((new FHIRCoding)->setCode($condition['code']))->setText($condition['display'] ?? null))
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"))
            ->setEncounter((new FHIRReference)->setReference("Encounter/{$encounterId}"));
    }

    private function buildDiagnosticReport(array $report, string $id, string $patientId, string $encounterId): FHIRDiagnosticReport
    {
        return (new FHIRDiagnosticReport($id))
            ->setStatus($report['status'])
            ->setCode((new FHIRCodeableConcept)->setCoding((new FHIRCoding)->setCode($report['code'])))
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"))
            ->setEncounter((new FHIRReference)->setReference("Encounter/{$encounterId}"));
    }

    private function buildProcedure(array $procedure, string $id, string $patientId, string $encounterId): FHIRProcedure
    {
        return (new FHIRProcedure($id))
            ->setStatus($procedure['status'])
            ->setCode((new FHIRCodeableConcept)->setCoding((new FHIRCoding)->setCode($procedure['code'])))
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"))
            ->setEncounter((new FHIRReference)->setReference("Encounter/{$encounterId}"));
    }

    private function buildMedicationRequest(array $medicationRequest, string $id, string $patientId, string $encounterId): FHIRMedicationRequest
    {
        return (new FHIRMedicationRequest($id))
            ->setStatus($medicationRequest['status'])
            ->setIntent($medicationRequest['intent'])
            ->setMedicationCodeableConcept((new FHIRCodeableConcept)->setCoding((new FHIRCoding)->setCode($medicationRequest['code'])))
            ->setSubject((new FHIRReference)->setReference("Patient/{$patientId}"))
            ->setEncounter((new FHIRReference)->setReference("Encounter/{$encounterId}"));
    }

    private function buildDevice(array $device, string $id): FHIRDevice
    {
        return (new FHIRDevice($id))
            ->setType((new FHIRCodeableConcept)->setCoding((new FHIRCoding)->setCode($device['type'])));
    }
}
