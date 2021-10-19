<?php

namespace App\Console\Commands;

use App\Models\OperMovement;
use App\Models\OperSchedule;
use Illuminate\Console\Command;

class OperSchedulesMovementsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oper_schedules:movements';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create daily oper_movements register';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $operSchedules = OperSchedule::with(OperSchedule::getRelationships())->get()->toArray();

        $data = null;

        foreach ($operSchedules as $operSchedule) {
            if ($operSchedule['periodicity'] == 'daily') {

                $date = date('Y-m-d');
                $dateStart = $date;
                $dateEnd = $date;
                $timeStart = $operSchedule['time_start'];
                $timeEnd = $operSchedule['time_end'];

                $data = [
                    'name' => $operSchedule['name'] . ' ' . $date,
                    'oper_sector_id' => $operSchedule['oper_sector_id'],
                    'oper_contractor_id' => $operSchedule['oper_contractor_id'],
                    'date_statr' => $dateStart,
                    'date_end' => $dateEnd,
                    'time_start' => $timeStart,
                    'time_end' => $timeEnd,
                    'time_total' => null,
                    'photo' => null,
                    'oper_schedule_id' => $operSchedule['id'],
                    'completed' => false
                ];

                $operMovementExists = OperMovement::where('oper_schedule_id', $operSchedule['id'])
                    ->where('date_statr', $dateStart)
                    ->where('date_end', $dateEnd)
                    ->where('oper_contractor_id', $operSchedule['oper_contractor_id'])
                    ->where('oper_sector_id', $operSchedule['oper_sector_id'])
                    ->first();

                if (!$operMovementExists) {
                    $this->createOperMovement($data);
                }

            }
        }

        return 0;
    }

    public function createOperMovement($data) {
        \DB::beginTransaction();
        try {
            OperMovement::create($data);
        } catch (\Exception $exception) {
            \DB::rollBack();
            return [
                'message' => $exception->getMessage(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine()
            ];
        }
        \DB::commit();
    }
}
