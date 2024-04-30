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

// master admin
Breadcrumbs::for('admin.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Data Admin', route('admin.index'));
});
Breadcrumbs::for('admin.create', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Create', route('admin.create'));
});
Breadcrumbs::for('admin.show', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Detail', url('dashboard/admin/{id}'));
});
Breadcrumbs::for('admin.edit', function ($trail) {
    $trail->parent('admin.index');
    $trail->push('Edit', url('dashboard/admin/{id}/edit'));
});

//master guru
Breadcrumbs::for('guru.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Data Guru', route('guru.index'));
});
Breadcrumbs::for('guru.create', function ($trail) {
    $trail->parent('guru.index');
    $trail->push('Create', route('guru.create'));
});
Breadcrumbs::for('guru.show', function ($trail) {
    $trail->parent('guru.index');
    $trail->push('Detail', url('dashboard/guru/{id}'));
});
Breadcrumbs::for('guru.edit', function ($trail) {
    $trail->parent('guru.index');
    $trail->push('Edit', url('dashboard/guru/{id}/edit'));
});

//master siswa
Breadcrumbs::for('siswa.index', function ($trail) {
    $trail->parent('dashboard');
    $trail->push('Data Siswa', route('siswa.index'));
});
Breadcrumbs::for('siswa.create', function ($trail) {
    $trail->parent('siswa.index');
    $trail->push('Create', route('siswa.create'));
});
Breadcrumbs::for('siswa.show', function ($trail) {
    $trail->parent('siswa.index');
    $trail->push('Detail', url('dashboard/siswa/{id}'));
});
Breadcrumbs::for('siswa.edit', function ($trail) {
    $trail->parent('siswa.index');
    $trail->push('Edit', url('dashboard/siswa/{id}/edit'));
});

//---WEB---

Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('/home'));
});
// master pelanggaran
Breadcrumbs::for('pelanggaran.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Master Pelanggaran', route('pelanggaran.index'));
});
Breadcrumbs::for('pelanggaran.create', function ($trail) {
    $trail->parent('pelanggaran.index');
    $trail->push('Create', route('pelanggaran.create'));
});
Breadcrumbs::for('pelanggaran.show', function ($trail) {
    $trail->parent('pelanggaran.index');
    $trail->push('Detail', url('pelanggaran/{id}'));
});
Breadcrumbs::for('pelanggaran.edit', function ($trail) {
    $trail->parent('pelanggaran.index');
    $trail->push('Edit', url('pelanggaran/{id}/edit'));
});

// sanksi
Breadcrumbs::for('data-sanksi.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Sanksi', route('data-sanksi.index'));
});
Breadcrumbs::for('data-sanksi.create', function ($trail) {
    $trail->parent('data-sanksi.index');
    $trail->push('Create', route('data-sanksi.create'));
});
Breadcrumbs::for('data-sanksi.show', function ($trail) {
    $trail->parent('data-sanksi.index');
    $trail->push('Detail', url('data-sanksi/{id}'));
});
Breadcrumbs::for('data-sanksi.edit', function ($trail) {
    $trail->parent('data-sanksi.index');
    $trail->push('Edit', url('data-sanksi/{id}/edit'));
});

//pelanggaran siswa
Breadcrumbs::for('pelanggaran-siswa.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Pelanggaran siswa', route('pelanggaran-siswa.index'));
});
Breadcrumbs::for('pelanggaran-siswa.create', function ($trail) {
    $trail->parent('pelanggaran-siswa.index');
    $trail->push('Create', route('pelanggaran-siswa.create'));
});
Breadcrumbs::for('pelanggaran-siswa.show', function ($trail) {
    $trail->parent('pelanggaran-siswa.index');
    $trail->push('Detail', url('pelanggaran-siswa/{id}'));
});
Breadcrumbs::for('pelanggaran-siswa.edit', function ($trail) {
    $trail->parent('pelanggaran-siswa.index');
    $trail->push('Edit', url('pelanggaran-siswa/{id}/edit'));
});