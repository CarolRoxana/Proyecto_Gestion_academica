@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-start">
        @include('layouts.left-menu')
        <div class="col-xs-11 col-sm-11 col-md-11 col-lg-10 col-xl-10 col-xxl-10">
            <div class="row pt-3">
                <div class="col ps-4">
                    <!-- <h1 class="display-6 mb-3"><i class="ms-auto bi bi-grid"></i> {{ __('Dashboard') }}</h1> -->
                    <div class="row dashboard">
                        <div class="col">
                            <div class="card rounded-pill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><i class="bi bi-person-lines-fill me-3"></i> Estudiantes totales</div>
                                        </div>
                                        <span class="badge bg-dark rounded-pill">{{$studentCount}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-pill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><i class="bi bi-person-lines-fill me-3"></i> Profesores totales</div>
                                        </div>
                                        <span class="badge bg-dark rounded-pill">{{$teacherCount}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card rounded-pill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold"><i class="bi bi-diagram-3 me-3"></i> Materias totales</div>
                                        </div>
                                        <span class="badge bg-dark rounded-pill">{{ $classCount }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col">
                            <div class="card rounded-pill">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="ms-2 me-auto">
                                            <div class="fw-bold">Total Books</div>
                                        </div>
                                        <span class="badge bg-dark rounded-pill">800</span>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header bg-transparent"><i class="bi bi-calendar-event me-2"></i> Eventos</div>
                                <div class="card-body text-dark">
                                    @include('components.events.event-calendar', ['editable' => 'false', 'selectable' => 'false'])
                                    {{-- <div class="overflow-auto" style="height: 250px;">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">List group item heading</h5>
                                                <small>3 days ago</small>
                                                </div>
                                                <p class="mb-1">Some placeholder content in a paragraph.</p>
                                                <small>And some small print.</small>
                                            </a>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-3">
                                <div class="card-header bg-transparent d-flex justify-content-between"><span><i class="bi bi-megaphone me-2"></i> Notificaciones</span> {{ $notices->links() }}</div>
                                <div class="card-body p-0 text-dark">
                                    <div>
                                        @isset($notices)
                                        <div class="accordion accordion-flush" id="noticeAccordion">
                                            @foreach ($notices as $notice)
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-heading{{$notice->id}}">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$notice->id}}" aria-expanded={{($loop->first)?"true":"false"}} aria-controls="flush-collapse{{$notice->id}}">
                                                        Fecha publicacion:: {{$notice->created_at}}
                                                    </button>
                                                </h2>
                                                <div id="flush-collapse{{$notice->id}}" class="accordion-collapse collapse {{($loop->first)?"show":"hide"}}" aria-labelledby="flush-heading{{$notice->id}}" data-bs-parent="#noticeAccordion">
                                                    <div class="accordion-body overflow-auto">{!!Purify::clean($notice->notice)!!}</div>
                                                </div>
                                            </div>
                                            @endforeach
                                            @endisset
                                            @if(count($notices) < 1)
                                                <div class="p-3">No hay noticias</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>
</div>
@endsection
