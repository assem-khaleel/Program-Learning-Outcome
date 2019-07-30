@php
/**
 * Created by PhpStorm.
 * User: dura
 * Date: 3/3/19
 * Time: 9:59 AM
 */
@endphp
<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">PERSONAL</li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="index.html">Minimal </a></li>
                        <li><a href="index2.html">Analytical</a></li>
                        <li><a href="index3.html">Demographical</a></li>
                        <li><a href="index4.html">Modern</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-quora fa-fw"></i><span class="hide-menu">Rubrics</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('rubric.index')}}">Rubric</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-book fa-fw"></i><span class="hide-menu">PLO</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('learning-outcome.index')}}">Program Learning Outcomes</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-cog fa-fw"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('institution.index')}}">Institution</a></li>
                        <li><a href="{{route('user.index')}}">Users</a></li>
                        <li><a href="{{route('college.index')}}">Colleges</a></li>
                        <li><a href="{{route('department.index')}}">Departments</a></li>
                        <li><a href="{{route('program.index')}}">Programs</a></li>
                        <li><a href="{{route('course.index')}}">Courses</a></li>
                        <li><a href="{{route('semester.index')}}">Semesters</a></li>
                        <li><a href="{{route('student.index')}}">Students</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" href="{{route('assignment.index')}}" aria-expanded="false"><i class="fa fa-check-square-o fa-fw"></i><span class="hide-menu">Assignments</span></a>
                </li>

            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
