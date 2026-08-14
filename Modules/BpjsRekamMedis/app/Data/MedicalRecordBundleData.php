<?php

namespace Modules\BpjsRekamMedis\Data;

/**
 * Plain input DTO for MedicalRecordBundleBuilder. Kept as clearly-typed arrays rather than
 * binding to any one upstream module's Eloquent models - the modules that would supply this
 * data (Modules\GeneralPatient, Modules\BpjsVClaim's Sep, Modules\MedicalRecordClinicalNote,
 * etc.) aren't all guaranteed to exist/be merged yet, so the caller (a future controller/job in
 * this or another module) is responsible for reading real hospital records and mapping them into
 * this shape. Every *_id field below is the LOCAL primary key of the record the entry represents -
 * MedicalRecordBundleBuilder passes it to SmartClaimIdMappingService to get a stable FHIR id.
 */
final readonly class MedicalRecordBundleData
{
    /**
     * @param  array{id:int,mr_number:string,name:string,gender:string,birth_date:string,marital_status_code:?string}  $patient
     * @param  array{id:int,status:string,class_code:string}  $encounter
     * @param  array{id:int,name:string,identifier:string}  $practitioner
     * @param  array{id:int,name:string,identifier:string}  $organization
     * @param  array<int, array{id:int,code:string,display:?string}>  $conditions
     * @param  array<int, array{id:int,code:string,status:string}>  $diagnosticReports
     * @param  array<int, array{id:int,code:string,status:string}>  $procedures
     * @param  array<int, array{id:int,code:string,status:string,intent:string}>  $medicationRequests
     * @param  array<int, array{id:int,type:string}>  $devices
     */
    public function __construct(
        public string $noSep,
        public string $compositionTitle,
        public string $compositionDate,
        public array $patient,
        public array $encounter,
        public array $practitioner,
        public array $organization,
        public array $conditions = [],
        public array $diagnosticReports = [],
        public array $procedures = [],
        public array $medicationRequests = [],
        public array $devices = [],
    ) {
    }
}
