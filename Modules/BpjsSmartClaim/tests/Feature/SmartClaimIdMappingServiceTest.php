<?php

namespace Modules\BpjsSmartClaim\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\BpjsSmartClaim\Models\SmartClaimIdMapping;
use Modules\BpjsSmartClaim\Services\SmartClaimIdMappingService;
use Tests\TestCase;

class SmartClaimIdMappingServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_new_mapping_for_an_unseen_local_record(): void
    {
        $service = new SmartClaimIdMappingService;

        $id = $service->idFor('patient', 42);

        $this->assertDatabaseHas('smart_claim_id_mappings', [
            'id' => $id,
            'ref_type' => 'patient',
            'ref_id' => 42,
        ]);
    }

    public function test_it_returns_the_same_id_for_the_same_local_record(): void
    {
        $service = new SmartClaimIdMappingService;

        $first = $service->idFor('encounter', 7, 'admission');
        $second = $service->idFor('encounter', 7, 'admission');

        $this->assertSame($first, $second);
        $this->assertSame(1, SmartClaimIdMapping::query()->count());
    }

    public function test_different_ref_types_with_the_same_ref_id_get_different_mappings(): void
    {
        $service = new SmartClaimIdMappingService;

        $patientId = $service->idFor('patient', 1);
        $encounterId = $service->idFor('encounter', 1);

        $this->assertNotSame($patientId, $encounterId);
    }
}
