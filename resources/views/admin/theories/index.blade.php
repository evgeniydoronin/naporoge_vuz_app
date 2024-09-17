<x-admin-layout>
  <!-- content @s -->
  <div class="nk-content ">
    <div class="container-fluid">
      <div class="nk-content-inner">
        <div class="nk-content-body">
          <div class="nk-block-head nk-block-head-sm">
            <div class="nk-block-between">
              <div class="nk-block-head-content">
                <h3 class="nk-block-title page-title">Теория к курсу и формы документов</h3>
              </div><!-- .nk-block-head-content -->
            </div><!-- .nk-block-between -->
          </div><!-- .nk-block-head -->

          <div class="nk-block nk-block-lg">
            <div class="card card-bordered card-preview">
              <div class="card-inner">

                <table class="table">
                  <thead>
                  <tr>
                    <th class="w-15">id</th>
                    <th>Заголовок</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                  @forelse($theories as $theory)
                    <tr>
                      <td>{{ $theory->id }}</td>
                      <td>
                        <a href="{{ route('theories.edit', $theory->id) }}">
                          {{ $theory->title }}
                        </a>
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