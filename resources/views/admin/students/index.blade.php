@php
    use App\Models\Code;
    use App\Models\User;
@endphp
<x-admin-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Все студенты</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                       data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                        data-bs-target="#updateStudentsModal">
                                                    <em class="icon ni ni-reports"></em><span>Обновить студентов</span>
                                                </button>

                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-students table">
                                    <thead>
                                    <tr>
                                        <th class="w-50px">id</th>
                                        <th>Код</th>
                                        <th>Телефон</th>
                                        <th>E-mail</th>
                                        <th>ФИО</th>
                                        <th>Был</th>
                                        <th>Аттестация</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($students as $student)
                                        @php
                                            $user = User::where('id',$student->user_id)->first();
                                            $code =  Code::where('user_id',$student->user_id)->first();
                                            $studentCode = '';
                                            $phone = $student->phone ?? '';
                                            $name = $user->name ?? '';
                                            $attestation = $student->attestation ?? '';
                                            if (!is_null($code)) {
                                              $studentCode = $code['code'];
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $student->user_id }}</td>
                                            <td>{{ $studentCode }}</td>
                                            <td>{{ $phone }}</td>
                                            <td></td>
                                            <td>{{ $name }}</td>
                                            <td>{{ $student->last_active_at ?? '' }}</td>
                                            <td>{{ $attestation }}</td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger">очистить</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="bg-danger text-white p-1">Нет записей</p>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->


                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->
</x-admin-layout>
