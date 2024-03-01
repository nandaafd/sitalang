<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', url('/dashboard/'));
});
Breadcrumbs::for('pelanggaransiswa.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Pelanggaran siswa', route('pelanggaransiswa.index'));
});
Breadcrumbs::for('pelanggaransiswa.create', function ($trail) {
    $trail->parent('pelanggaransiswa.index');
    $trail->push('Create', route('pelanggaransiswa.create'));
});
Breadcrumbs::for('pelanggaransiswa.show', function ($trail) {
    $trail->parent('pelanggaransiswa.index');
    $trail->push('Detail', url('dashboard/pelanggaransiswa/{id}'));
});
Breadcrumbs::for('pelanggaransiswa.edit', function ($trail) {
    $trail->parent('pelanggaransiswa.index');
    $trail->push('Edit', url('dashboard/pelanggaransiswa/{id}/edit'));
});