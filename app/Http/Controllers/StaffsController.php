<?php

namespace App\Http\Controllers;

use App\Models\Staffs;
use Illuminate\Http\Request;
use App\Libs\StaffsUtil;
use Illuminate\Validation\Rule;

class StaffsController extends Controller
{
    // バリデーションオプション
    public static $validation_option = [
        'staff_code' => ['required','string','min:4','max:4'], // 社員コード
        'last_name' => ['required','string','max:20'], // 姓
        'first_name' => ['required','string','max:20'], // 名
        'last_name_romaji' => ['required','alpha','string','max:40'], // 姓(ローマ字)
        'first_name_romaji' => ['required','alpha','string','max:40'], // 名(ローマ字)
        'mail_address' => ['required','email:rfc'],
        'staff_department' => ['required'], // 所属
        'joined_year' => ['required','date'], // 入社日
        'project_type' => ['max:100'], // 案件
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staffs = Staffs::Where('delete_flg', '=', 0)->get();
        foreach ($staffs as $staff) {
            $staff->job_name = StaffsUtil::$job_list[$staff->staff_department];
            $staff->new_glad = StaffsUtil::glad_flg((int)$staff->new_glad_flg);
        }

        return view('index',['staffs' => $staffs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('new',  ['job_list' => StaffsUtil::$job_list]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 追加バリデーション
        $validation_option = StaffsController::$validation_option;
        array_push($validation_option["staff_code"], "unique:App\Models\Staffs,staff_code");
        array_push($validation_option["staff_department"], Rule::in(array_keys(StaffsUtil::$job_list)));
        $validation_option = array_merge($validation_option,array('new_glad_flg'=> Rule::in(StaffsUtil::$new_glad_flg)));
        $validated = $request->validate($validation_option);

        $staff = new Staffs;

        $staff->staff_code = $request->staff_code;
        $staff->last_name = $request->last_name;
        $staff->first_name = $request->first_name;
        $staff->last_name_romaji = $request->last_name_romaji;
        $staff->first_name_romaji = $request->first_name_romaji;
        $staff->mail_address = $request->mail_address;
        $staff->staff_department = $request->staff_department;
        $staff->new_glad_flg = is_null($request->new_glad_flg)? 0 : $request->new_glad_flg;
        $staff->joined_year = $request->joined_year;
        $staff->project_type = $request->project_type;

        $staff->save();
        return redirect()->route('staff.show', ['id' => $staff->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Staffs $staffs)
    {
        if (!$id) {
            return view('error',['error_msg'=> '社員IDがないため表示できません。']);
        }

        $staff_paramertar = Staffs::find($id);
        if (is_null($staff_paramertar) || $staff_paramertar->delete_flg == '1') {
            return view('error',['error_msg'=> '存在しない社員IDのため表示できません。']);
        }
        // 所属設定
        $staff_paramertar->job_name = StaffsUtil::$job_list[$staff_paramertar->staff_department];
        // 新卒中途設定
        $staff_paramertar->new_glad = StaffsUtil::glad_flg((int)$staff_paramertar->new_glad_flg);

        return view('show',  ['staff_paramertar' => $staff_paramertar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, Staffs $staffs)
    {
        if (!$id) {
            return view('error',['error_msg'=> '社員IDがないため表示できません。']);
        }

        $staff_paramertar = Staffs::find($id);
        if (is_null($staff_paramertar) || $staff_paramertar->delete_flg == '1') {
            return view('error',['error_msg'=> '存在しない社員IDのため表示できません。']);
        }
        $staff_paramertar->joined_year  = date('Y-m-d',strtotime($staff_paramertar->joined_year));
        return view('edit',  ['staff_paramertar' => $staff_paramertar,'job_list' => StaffsUtil::$job_list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Staffs $staffs)
    {
        // 追加バリデーション
        $validation_option = StaffsController::$validation_option;
        array_push($validation_option["staff_department"], Rule::in(array_keys(StaffsUtil::$job_list)));
        $validation_option = array_merge($validation_option,array('new_glad_flg'=> Rule::in(StaffsUtil::$new_glad_flg)));
        unset($validation_option["staff_code"]);
        // バリデーション
        $validated = $request->validate($validation_option);

        $staff = Staffs::find($id);
        $staff->last_name = $request->last_name;
        $staff->first_name = $request->first_name;
        $staff->last_name_romaji = $request->last_name_romaji;
        $staff->first_name_romaji = $request->first_name_romaji;
        $staff->mail_address = $request->mail_address;
        $staff->staff_department = $request->staff_department;
        $staff->new_glad_flg = is_null($request->new_glad_flg)? 0 : $request->new_glad_flg;
        $staff->joined_year = $request->joined_year;
        $staff->project_type = $request->project_type;

        $staff->save();
        return redirect()->route('staff.show', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staffs  $staffs
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $staff = Staffs::find($id);
        $staff->delete_flg = '1';
        $staff->save();
        return redirect('/staffs');
    }
}
