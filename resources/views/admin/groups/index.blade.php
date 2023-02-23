<x-app-layout>

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Все группы</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt"><a href="{{ route('groups.create') }}" class="btn btn-primary"><em class="icon ni ni-plus-circle"></em><span>Добавить Группу</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-group table" data-export-title="Экспорт">
                                    <thead class="align-middle">
                                    <tr>
                                        <th class="w-10">id</th>
                                        <th>Группа</th>
                                        <th>Дата старта</th>
                                        <th>Ведущий</th>
                                        <th>Коды</th>
                                        <th>Экспорт</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($groups as $group)
                                        <tr>
                                            <td>{{ $group->id }}</td>
                                            <td>
                                                <a href="{{ route('groups.edit', $group->id) }}">
                                                    {{ $group->name }}
                                                </a>
                                            </td>
                                            <td>{{ $group->start_at }}</td>
                                            <td>{{ $group->teachers }}</td>
                                            <td><a href="{{ route('getCodesIdByGroupId', $group->id) }}" class="btn btn-sm btn-outline-success">скачать</a></td>
                                            <td>
                                                <div class="custom-control custom-control-sm custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck7">
                                                    <label class="custom-control-label" for="customCheck7"></label>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <p>Нет записей</p>
                                    @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-end mt-2">
                                    <a href="" class="btn btn-lg btn-primary">скачать выбранное</a>
                                </div>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->


                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

</x-app-layout>
