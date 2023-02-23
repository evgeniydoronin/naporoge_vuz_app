<x-app-layout>

    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Все вузы</h3>
                            </div><!-- .nk-block-head-content -->
                            <div class="nk-block-head-content">
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                    <div class="toggle-expand-content" data-content="pageMenu">
                                        <ul class="nk-block-tools g-3">
                                            <li class="nk-block-tools-opt"><a href="{{ route('universities.create') }}" class="btn btn-primary"><em class="icon ni ni-plus-circle"></em><span>Добавить ВУЗ</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-vuz table" data-export-title="Экспорт">
                                    <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Наименование</th>
                                        <th>Регистрация</th>
                                        <th class="w-150px">Групп</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($universities as $university)
                                        @php
                                        $groups = \App\Models\University::find($university->id)->groups->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $university->id }}</td>
                                            <td>
                                                <a href="{{ route('universities.edit', $university->id) }}">
                                                   {{ $university->name }}
                                                </a>
                                            </td>
                                            <td>{{ Carbon\Carbon::parse($university->created_at)->format('d-m-Y') }}</td>
                                            <td>{{ $groups }}</td>
                                        </tr>
                                    @empty
                                        <p>Нет записей</p>
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

</x-app-layout>
