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
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt">

                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStudentsModal">
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
                                    <tr>
                                        <td>1</td>
                                        <td>3Ww0de</td>
                                        <td>+79008007060</td>
                                        <td>student@gmail.com</td>
                                        <td>Соколова Екатерина Андреевна</td>
                                        <td>12-03-2022</td>
                                        <td>2</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-danger">очистить</a>
                                        </td>
                                    </tr>
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
