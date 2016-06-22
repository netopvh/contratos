<?php


Breadcrumbs::setView('layouts.partials.breadcrumbs');

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

/*
 * Inicio Perfis
 */
Breadcrumbs::register('role.index', function($breadcrumbs) {
$breadcrumbs->parent('home');
$breadcrumbs->push('Perfis', route('roles.index'));
});

Breadcrumbs::register('role.create', function($breadcrumbs) {
    $breadcrumbs->parent('role.index');
    $breadcrumbs->push('Novo', route('roles.create'));
});

Breadcrumbs::register('role.edit', function($breadcrumbs) {
    $breadcrumbs->parent('role.index');
    $breadcrumbs->push('Editar', '');
});

Breadcrumbs::register('role.permissions', function($breadcrumbs) {
    $breadcrumbs->parent('role.index');
    $breadcrumbs->push('Permissões', '');
});

/*
 * Fim dos Perfis
 */

/*
 * Inicio Permissões
 */

Breadcrumbs::register('permissions.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Grupos e Permissões', route('permissions.index'));
});

Breadcrumbs::register('permissions.create', function($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Nova Permissão', route('permissions.create'));
});

Breadcrumbs::register('permissions.edit', function($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Editar Permissão', '');
});

Breadcrumbs::register('groups.create', function($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Novo Grupo', route('groups.create'));
});

Breadcrumbs::register('groups.edit', function($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Editar Grupo', '');
});

/*
 * Fim dos Permissões
 */

/*
 * Inicio Usuários
 */
Breadcrumbs::register('user.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Usuários', route('users.index'));
});
Breadcrumbs::register('user.edit', function($breadcrumbs) {
    $breadcrumbs->parent('user.index');
    $breadcrumbs->push('Editar', '');
});


/*
 * Início Casas
 */
Breadcrumbs::register('casas.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Casas', route('casas.index'));
});

Breadcrumbs::register('casas.create', function($breadcrumbs) {
    $breadcrumbs->parent('casas.index');
    $breadcrumbs->push('Nova', route('casas.create'));
});

Breadcrumbs::register('casas.edit', function($breadcrumbs) {
    $breadcrumbs->parent('casas.index');
    $breadcrumbs->push('Editar', '');
});

/*
 * Fim Casas
 */

/*
 * Início Unidades
 */
Breadcrumbs::register('unidades.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Unidades', route('unidades.index'));
});

Breadcrumbs::register('unidades.create', function($breadcrumbs) {
    $breadcrumbs->parent('unidades.index');
    $breadcrumbs->push('Nova', route('unidades.create'));
});

Breadcrumbs::register('unidades.edit', function($breadcrumbs) {
    $breadcrumbs->parent('unidades.index');
    $breadcrumbs->push('Editar', '');
});

/*
 * Fim Unidades
 */


/*
 * Início Empresas
 */
Breadcrumbs::register('empresas.index', function($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Fornecedores', route('empresas.index'));
});

Breadcrumbs::register('empresas.create', function($breadcrumbs) {
    $breadcrumbs->parent('empresas.index');
    $breadcrumbs->push('Novo', route('empresas.create'));
});

Breadcrumbs::register('empresas.edit', function($breadcrumbs) {
    $breadcrumbs->parent('empresas.index');
    $breadcrumbs->push('Editar', '');
});

/*
 * Fim Empresas
 */