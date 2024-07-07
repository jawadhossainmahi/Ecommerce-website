<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;

class BatchController extends Controller
{
    public function getBatchProgress($batchId)
    {
        $batch = Bus::findBatch($batchId);
        if (!$batch) {
            return response()->json(['error' => 'Batch not found.'], 404);
        }

        $progress = $batch->progress();
        // 'progress' => $progress,
        return response()->json([
            'progress' => 100,
            'totaljobs' => $batch->totalJobs, 
            'paindingJObs' => $batch->pendingJobs,
            'failedjobs' => $batch->failedJobs,
            'processedjobs' => $batch->processedJobs()
        ]);
    }
}
