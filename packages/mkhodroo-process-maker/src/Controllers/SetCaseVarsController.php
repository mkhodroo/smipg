<?php

namespace Mkhodroo\MkhodrooProcessMaker\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SoapClient;

class SetCaseVarsController extends Controller
{
    private $accessToken;

    public function __construct()
    {
    }
    function saveAndNext(Request $r)
    {
        $this->save($r);

        $system_vars = (new GetCaseVarsController())->getByCaseId($r->caseId);
        $steps = StepController::list($system_vars->PROCESS, $system_vars->TASK);

        foreach ($steps as $step) {
            $triggers = $step->triggers;
            foreach ($triggers as $trigger) {
                if ($trigger->st_type === "AFTER") {
                    TriggerController::excute($trigger->tri_uid, $system_vars->APPLICATION);
                }
            }
        }

        return RouteCaseController::next($r->caseId, $r->del_index);
        return response("انجام شد", 200);
    }

    function save(Request $r)
    {
        $sessionId = AuthController::wsdl_login()->message;
        $client = new SoapClient(str_replace('https', 'http', env('PM_SERVER')) . '/sysworkflow/en/green/services/wsdl2');
        $vars = $r->except(
            'caseId',
            'SYS_LANG',
            'SYS_SKIN',
            'SYS_SYS',
            'APPLICATION',
            'PROCESS',
            'TASK',
            'INDEX',
            'USER_LOGGED',
            'USR_USERNAME',
            'APP_NUMBER',
            'PIN'
        );
        $variables = array();
        foreach ($vars as $key => $val) {
            if (gettype($val) == 'object') {
                InputDocController::upload($r->taskId, $r->caseId, $key, $r->file($key));
            } else {
                $obj = new variableListStruct();
                $obj->name = $key;
                $obj->value = $val;
                $variables[] = $obj;
            }
        }
        $params = array(array('sessionId' => $sessionId, 'caseId' => $r->caseId, 'variables' => $variables));
        $result = $client->__SoapCall('sendVariables', $params);
        if ($result->status_code != 0)
            return response($result->message, 400);


        return response("ok", 200);
    }
}

class variableListStruct
{
    public $name;
    public $value;
}
