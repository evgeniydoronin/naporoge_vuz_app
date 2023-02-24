<x-app-layout>
    <!-- content @s -->
    <div class="nk-content ">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Менеджеры</h3>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block">
                        <div class="row g-gs">

                            <div class="col-xxl-12 col-md-12">
                                <div class="card">
                                    <div class="card-inner">

                                        @error('email')
                                        <div style="display:block" class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        <form action="{{ route('managers.store') }}" method="post" class="gy-3 form-validate">
                                            @csrf

                                            <div class="row g-3 align-center">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold" for="default-06">E-mail</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="email" class="form-control" id="fv-full-name-group" required placeholder="E-mail">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold" for="default-06">ФИО</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" name="name" class="form-control" id="fv-full-name-group" required placeholder="ФИО">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="custom-control custom-control-sm custom-checkbox">
                                                        <input type="checkbox" name="is_cleaner" class="custom-control-input" id="customCheck7">
                                                        <label class="custom-control-label" for="customCheck7">Разрешить очистку студентов</label>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <div class="form-group mt-2 d-flex justify-content-between">
                                                        <button type="submit" class="btn btn-lg btn-primary">Создать</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div><!-- card -->
                            </div><!-- .col -->


                            <div class="col-xxl-12 col-md-12">
                                <div class="card">
                                    <div class="card-inner">
                                        <table class="table">
                                            <thead class="table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">E-mail</th>
                                                <th scope="col">ФИО</th>
                                                <th scope="col">Очистка студентов</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @forelse ($managers as $manager)
                                                <tr>
                                                    <td>{{ $manager->user_id }}</td>
                                                    <td>{{ \App\Models\User::find($manager->user_id)->email }}</td>
                                                    <td>{{ \App\Models\User::find($manager->user_id)->name }}</td>
                                                    <form action="{{ route('managers.update', $manager->user_id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <td>
                                                            <div class="custom-control custom-control-sm custom-checkbox">
                                                                <input type="checkbox" name="is_cleaner" value="1" {{ $manager->is_cleaner ? 'checked' : '' }} class="custom-control-input"
                                                                       id="isCleanerCheckbox-{{ $manager->user_id }}">
                                                                <label class="custom-control-label" for="isCleanerCheckbox-{{ $manager->user_id }}"></label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-sm btn-success">Обновить</button>
                                                        </td>
                                                    </form>
                                                    <td class="d-flex justify-content-end">
                                                        <form action="{{ route('managers.destroy', $manager->user_id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="submit" class="btn btn-icon btn-sm btn-outline-danger"><em class="icon ni ni-trash"></em></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <p class="bg-danger text-white p-1">Нет записей</p>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- card -->
                            </div><!-- .col -->

                        </div><!-- .row -->
                    </div><!-- .nk-block -->
                </div>
            </div>
        </div>
    </div>
    <!-- content @e -->

</x-app-layout>
