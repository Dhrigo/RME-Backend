<?php

namespace Modules\EKlaim\Services;

use Modules\EKlaim\Models\EklaimCall;

/**
 * Wraps Modules\EKlaim\Services\EklaimClient with a local audit ledger and
 * named convenience methods for the ws.php `metadata.method` catalog
 * confirmed in inacbg_manual.txt bagian IV (~30 methods grepped directly:
 * claim_final, claim_print, delete_claim, delete_patient,
 * generate_claim_number, get_claim_data, get_claim_status, grouper,
 * idrg_diagnosa_get/set, idrg_grouper_final/reedit, idrg_procedure_set,
 * idrg_to_inacbg_import, inacbg_diagnosa_set, inacbg_grouper_final/reedit,
 * inacbg_procedure_get/set, new_claim, reedit_claim, search_diagnosis(_inagrouper),
 * search_procedures(_inagrouper), send_claim(_individual), set_claim_data,
 * sitb_invalidate/validate, update_patient).
 *
 * The legacy ZF2 EklaimController.php (cross-check source) exposes several
 * extra actions - setEncounterRMEAction, dokumenPendukungAction (with an
 * exact field doc-comment), uploadFilePendukung/hapusFilePendukung/
 * daftarFilePendukung - whose `metadata.method` name was NOT independently
 * found in the manual's grep. Rather than fabricate those names, they are
 * exposed only through the generic call() passthrough below; callers must
 * supply the exact method string once confirmed against a live E-Klaim
 * install. dokumenPendukung() below uses the exact field shape documented
 * in EklaimController's doc-comment as a convenience builder for that call,
 * but still goes through the same unconfirmed-method passthrough.
 */
class EklaimService
{
    public function __construct(private readonly EklaimClient $client)
    {
    }

    /** Generic passthrough for any ws.php method, confirmed or not. */
    public function call(string $method, array $data = []): EklaimCall
    {
        $local = EklaimCall::create([
            'method' => $method,
            'request_data' => $data,
            'status' => 'pending',
        ]);

        try {
            $response = $this->client->call($method, $data);
            $local->update(['response_data' => $response, 'status' => 'sent']);
        } catch (\Throwable $e) {
            $local->update(['status' => 'failed', 'error_message' => $e->getMessage()]);
        }

        return $local->fresh();
    }

    // ---- Confirmed manual methods (bagian IV) ---------------------------

    public function grouper(array $data): EklaimCall
    {
        return $this->call('grouper', $data);
    }

    public function newClaim(array $data): EklaimCall
    {
        return $this->call('new_claim', $data);
    }

    public function setClaimData(array $data): EklaimCall
    {
        return $this->call('set_claim_data', $data);
    }

    public function getClaimData(array $data): EklaimCall
    {
        return $this->call('get_claim_data', $data);
    }

    public function getClaimStatus(array $data): EklaimCall
    {
        return $this->call('get_claim_status', $data);
    }

    public function idrgDiagnosaSet(array $data): EklaimCall
    {
        return $this->call('idrg_diagnosa_set', $data);
    }

    public function idrgDiagnosaGet(array $data): EklaimCall
    {
        return $this->call('idrg_diagnosa_get', $data);
    }

    public function idrgProcedureSet(array $data): EklaimCall
    {
        return $this->call('idrg_procedure_set', $data);
    }

    public function idrgGrouperFinal(array $data): EklaimCall
    {
        return $this->call('idrg_grouper_final', $data);
    }

    public function idrgGrouperReedit(array $data): EklaimCall
    {
        return $this->call('idrg_grouper_reedit', $data);
    }

    public function idrgToInacbgImport(array $data): EklaimCall
    {
        return $this->call('idrg_to_inacbg_import', $data);
    }

    public function inacbgDiagnosaSet(array $data): EklaimCall
    {
        return $this->call('inacbg_diagnosa_set', $data);
    }

    public function inacbgProcedureSet(array $data): EklaimCall
    {
        return $this->call('inacbg_procedure_set', $data);
    }

    public function inacbgProcedureGet(array $data): EklaimCall
    {
        return $this->call('inacbg_procedure_get', $data);
    }

    public function inacbgGrouperFinal(array $data): EklaimCall
    {
        return $this->call('inacbg_grouper_final', $data);
    }

    public function inacbgGrouperReedit(array $data): EklaimCall
    {
        return $this->call('inacbg_grouper_reedit', $data);
    }

    public function claimFinal(array $data): EklaimCall
    {
        return $this->call('claim_final', $data);
    }

    public function reeditClaim(array $data): EklaimCall
    {
        return $this->call('reedit_claim', $data);
    }

    public function deleteClaim(array $data): EklaimCall
    {
        return $this->call('delete_claim', $data);
    }

    public function deletePatient(array $data): EklaimCall
    {
        return $this->call('delete_patient', $data);
    }

    public function updatePatient(array $data): EklaimCall
    {
        return $this->call('update_patient', $data);
    }

    public function sendClaim(array $data): EklaimCall
    {
        return $this->call('send_claim', $data);
    }

    public function sendClaimIndividual(array $data): EklaimCall
    {
        return $this->call('send_claim_individual', $data);
    }

    public function generateClaimNumber(array $data): EklaimCall
    {
        return $this->call('generate_claim_number', $data);
    }

    public function claimPrint(string $nomorSep): EklaimCall
    {
        // exact field name confirmed in the manual's own example (bagian III).
        return $this->call('claim_print', ['nomor_sep' => $nomorSep]);
    }

    public function searchDiagnosis(array $data): EklaimCall
    {
        return $this->call('search_diagnosis', $data);
    }

    public function searchDiagnosisInagrouper(array $data): EklaimCall
    {
        return $this->call('search_diagnosis_inagrouper', $data);
    }

    public function searchProcedures(array $data): EklaimCall
    {
        return $this->call('search_procedures', $data);
    }

    public function searchProceduresInagrouper(array $data): EklaimCall
    {
        return $this->call('search_procedures_inagrouper', $data);
    }

    public function sitbValidate(array $data): EklaimCall
    {
        return $this->call('sitb_validate', $data);
    }

    public function sitbInvalidate(array $data): EklaimCall
    {
        return $this->call('sitb_invalidate', $data);
    }

    // ---- Convenience builder for an unconfirmed legacy action -----------

    /**
     * Field shape ported exactly from EklaimController::dokumenPendukungAction()'s
     * doc-comment (id, no_klaim, file_id, file_class, file_name, file_size,
     * file_type, file_content base64, document_id, tanggal, oleh, status).
     * The ws.php `metadata.method` string itself was NOT found in the manual
     * grep - caller must supply/confirm it.
     */
    public function dokumenPendukung(string $method, array $data): EklaimCall
    {
        return $this->call($method, $data);
    }
}
