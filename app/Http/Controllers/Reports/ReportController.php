<?php

namespace App\Http\Controllers\Reports;
use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\LearningOutcome;
use App\Models\Settings\College;
use App\Models\Settings\Course;
use App\Models\Settings\CourseSection;
use App\Models\Settings\Department;
use App\Models\Settings\Program;
use App\Models\Settings\Student;
use App\Models\Settings\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @var User $user
     */
    protected $college;

    protected $department;

    protected $program;

    protected $plo;

    protected $student;

    /**
     * ProfileController constructor.
     * @param User $user
     * @param File $file
     */
    public function __construct(College $college, Department $department, Program $program, LearningOutcome $plo,Student $student)
    {
        $this->college = $college;
        $this->department = $department;
        $this->program = $program;
        $this->plo = $plo;
        $this->student= $student;
    }

    public function institution()
    {
        $colleges = $this->college->whereHas('departments')->paginate(15);
        $plos = $this->plo->all();

        return view('reports.institution')->with('colleges', $colleges)->with('plos',$plos);
    }

    public function student(){
        $students = $this->student->whereHas('CourseSections')->paginate(15);

        return view('reports.index')->with('students', $students);
    }


}
