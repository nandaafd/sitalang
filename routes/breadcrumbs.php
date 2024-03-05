<?php

use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('dashboard', function ($trail) {
    $trail->push('Dashboard', url('/dashboard/'));
});

//pelanggaran siswa
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

// kelas
Breadcrumbs::for('kelas.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Kelas', route('kelas.index'));
});
Breadcrumbs::for('kelas.create', function ($trail) {
    $trail->parent('kelas.index');
    $trail->push('Create', route('kelas.create'));
});
Breadcrumbs::for('kelas.show', function ($trail) {
    $trail->parent('kelas.index');
    $trail->push('Detail', url('dashboard/kelas/{id}'));
});
Breadcrumbs::for('kelas.edit', function ($trail) {
    $trail->parent('kelas.index');
    $trail->push('Edit', url('dashboard/kelas/{id}/edit'));
});

// sanksi
Breadcrumbs::for('sanksi.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Sanksi', route('sanksi.index'));
});
Breadcrumbs::for('sanksi.create', function ($trail) {
    $trail->parent('sanksi.index');
    $trail->push('Create', route('sanksi.create'));
});
Breadcrumbs::for('sanksi.show', function ($trail) {
    $trail->parent('sanksi.index');
    $trail->push('Detail', url('dashboard/sanksi/{id}'));
});
Breadcrumbs::for('sanksi.edit', function ($trail) {
    $trail->parent('sanksi.index');
    $trail->push('Edit', url('dashboard/sanksi/{id}/edit'));
});

// master pelanggaran
Breadcrumbs::for('masterpelanggaran.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Master Pelanggaran', route('masterpelanggaran.index'));
});
Breadcrumbs::for('masterpelanggaran.create', function ($trail) {
    $trail->parent('masterpelanggaran.index');
    $trail->push('Create', route('masterpelanggaran.create'));
});
Breadcrumbs::for('masterpelanggaran.show', function ($trail) {
    $trail->parent('masterpelanggaran.index');
    $trail->push('Detail', url('dashboard/masterpelanggaran/{id}'));
});
Breadcrumbs::for('masterpelanggaran.edit', function ($trail) {
    $trail->parent('masterpelanggaran.index');
    $trail->push('Edit', url('dashboard/masterpelanggaran/{id}/edit'));
});