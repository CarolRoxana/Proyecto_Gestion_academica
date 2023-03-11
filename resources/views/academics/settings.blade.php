@extends('layouts.app')

@section('content')
<script src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-2">
                <div class="col ps-4">
                    <h1 class="display-6 mb-3">
                        <i class="bi bi-tools"></i> Configuracion academica
                    </h1>

                    @include('session-messages')

                    <div class="mb-4">
                        <div class="row" data-masonry='{"percentPosition": true }'>
                            @if ($latest_school_session_id == $current_school_session_id)
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Create Session</h6>
                                    <p class="text-danger">
                                        <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Crear una sesion por semestre o periodo estudiantil</small>
                                    </p>
                                    <form action="{{route('school.session.store')}}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm" placeholder="2022-II" aria-label="Current Session" name="session_name" required>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-check2"></i> Crear</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Buscar por sesion</h6>
                                    <form action="{{route('school.session.browse')}}" method="POST">
                                        @csrf
                                    <div class="mb-3">
                                        <p class="mt-2">Seleccione una sesion:</p>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm" name="session_id" required>
                                            @isset($school_sessions)
                                                @foreach ($school_sessions as $school_session)
                                                    <option value="{{$school_session->id}}">{{$school_session->session_name}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                    <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-check2"></i> establecer</button>
                                    </form>
                                </div>
                            </div>
                            @if ($latest_school_session_id == $current_school_session_id)
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Crear semestre para sesion actual</h6>
                                    <form action="{{route('school.semester.create')}}" method="POST">
                                        @csrf
                                    <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                    <div class="mt-2">
                                        <p>Nombre semestre<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                        <input type="text" class="form-control form-control-sm" placeholder="Primer semestre" aria-label="Semester name" name="semester_name" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputStarts" class="form-label">Inicia<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="date" class="form-control form-control-sm" id="inputStarts" placeholder="Inicio" name="start_date" required>
                                    </div>
                                    <div class="mt-2">
                                        <label for="inputEnds" class="form-label">Termina<sup><i class="bi bi-asterisk text-primary"></i></sup></label>
                                        <input type="date" class="form-control form-control-sm" id="inputEnds" placeholder="Fin" name="end_date" required>
                                    </div>
                                    <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Crear</button>
                                </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Tipo de asistencia</h6>
                                    <form action="{{route('school.attendance.type.update')}}" method="POST">
                                        @csrf
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="attendance_type" id="attendance_type_section" {{($academic_setting->attendance_type == 'section')?'checked="checked"':null}} value="section">
                                            <label class="form-check-label" for="attendance_type_section">
                                                Remoto
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="attendance_type" id="attendance_type_course" {{($academic_setting->attendance_type == 'course')?'checked="checked"':null}} value="course">
                                            <label class="form-check-label" for="attendance_type_course">
                                                Presencial
                                            </label>
                                        </div>

                                        <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Guardar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Crear carrera</h6>
                                    <form action="{{route('school.class.create')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                        <div class="mb-3">
                                            <input type="text" class="form-control form-control-sm" name="class_name" placeholder="Nombre carrera" aria-label="Class name" required>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-check2"></i> Crear</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                <h6>Crear seccion</h6>
                                    <form action="{{route('school.section.create')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                        <div class="mb-3">
                                            <input class="form-control form-control-sm" name="section_name" type="text" placeholder="Nombre seccion" required>
                                        </div>
                                        <div class="mb-3">
                                            <input class="form-control form-control-sm" name="room_no" type="text" placeholder="" required>
                                        </div>
                                        <div>
                                            <p>Asignar seccion a carrera:</p>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm" name="class_id" required>
                                                @isset($school_classes)
                                                    @foreach ($school_classes as $school_class)
                                                    <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Guardar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Crear materia</h6>
                                    <form action="{{route('school.course.create')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                        <div class="mb-1">
                                            <input type="text" class="form-control form-control-sm" name="course_name" placeholder="nombre materia" aria-label="Nombre materia" required>
                                        </div>
                                        <div class="mb-3">
                                            <p class="mt-2">Tipo materia:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" name="course_type" aria-label=".form-select-sm" required>
                                                <option value="Core">Core</option>
                                                <option value="General">General</option>
                                                <option value="Elective">Electiva</option>
                                                <option value="Optional">Opcional</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <p>Asignar a semestre:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm" name="semester_id" required>
                                                @isset($semesters)
                                                    @foreach ($semesters as $semester)
                                                    <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <p>Asignar a carrera:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm" name="class_id" required>
                                                @isset($school_classes)
                                                    @foreach ($school_classes as $school_class)
                                                    <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <button class="btn btn-sm btn-outline-primary" type="submit"><i class="bi bi-check2"></i>   Crear</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Asignar docente</h6>
                                    <form action="{{route('school.teacher.assign')}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="session_id" value="{{$current_school_session_id}}">
                                        <div class="mb-3">
                                            <p class="mt-2">Seleccionar docente:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm" name="teacher_id" required>
                                                @isset($teachers)
                                                    @foreach ($teachers as $teacher)
                                                    <option value="{{$teacher->id}}">{{$teacher->first_name}} {{$teacher->last_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <p>asignar a semestre:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" aria-label=".form-select-sm" name="semester_id" required>
                                                @isset($semesters)
                                                    @foreach ($semesters as $semester)
                                                    <option value="{{$semester->id}}">{{$semester->semester_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div>
                                            <p>Asignar a carrera:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select onchange="getSectionsAndCourses(this);" class="form-select form-select-sm" aria-label=".form-select-sm" name="class_id" required>
                                                @isset($school_classes)
                                                    <option selected disabled>Porfavor seleccione una carrera</option>
                                                    @foreach ($school_classes as $school_class)
                                                    <option value="{{$school_class->id}}">{{$school_class->class_name}}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                        <div>
                                            <p class="mt-2">Asignar seccion:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" id="section-select" aria-label=".form-select-sm" name="section_id" required>
                                            </select>
                                        </div>
                                        <div>
                                            <p class="mt-2">Asignar materia:<sup><i class="bi bi-asterisk text-primary"></i></sup></p>
                                            <select class="form-select form-select-sm" id="course-select" aria-label=".form-select-sm" name="course_id" required>
                                            </select>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Guardar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="p-3 border bg-light shadow-sm">
                                    <h6>Admitir carga de notas finales</h6>
                                    <form action="{{route('school.final.marks.submission.status.update')}}" method="POST">
                                        @csrf
                                        <p class="text-primary">
                                            <small><i class="bi bi-exclamation-diamond-fill me-2"></i> Es recomendable deshabilitarlo al inicio del semestre.</small>
                                        </p>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="marks_submission_status" id="marks_submission_status_check" {{($academic_setting->marks_submission_status == 'on')?'checked="checked"':null}}>
                                            <label class="form-check-label" for="marks_submission_status_check">{{($academic_setting->marks_submission_status == 'on')?'Activo':'Inactivo'}}</label>
                                        </div>
                                        <button type="submit" class="mt-3 btn btn-sm btn-outline-primary"><i class="bi bi-check2"></i> Guardar</button>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
<script>
    function getSectionsAndCourses(obj) {
        var class_id = obj.options[obj.selectedIndex].value;

        var url = "{{route('get.sections.courses.by.classId')}}?class_id=" + class_id

        fetch(url)
        .then((resp) => resp.json())
        .then(function(data) {
            var sectionSelect = document.getElementById('section-select');
            sectionSelect.options.length = 0;
            data.sections.unshift({'id': 0,'section_name': 'Porfavor seleccione una seccion'})
            data.sections.forEach(function(section, key) {
                sectionSelect[key] = new Option(section.section_name, section.id);
            });

            var courseSelect = document.getElementById('course-select');
            courseSelect.options.length = 0;
            data.courses.unshift({'id': 0,'course_name': 'Please select a course'})
            data.courses.forEach(function(course, key) {
                courseSelect[key] = new Option(course.course_name, course.id);
            });
        })
        .catch(function(error) {
            console.log(error);
        });
    }
</script>
@endsection
