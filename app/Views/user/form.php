<?php $this->extend('template') ?>
<?php
    $user = !isset($user) ? session()->getFlashdata('data')['user'] ?? [] : $user;
    $isEditing = $user['id'] ?? false;
?>

<?php $this->section('title') ?>
<?= $isEditing ? 'Edit User' : 'Add New User'?>
<?php $this->endSection() ?>

<?php $this->section('menuTags') ?>user add new<?php $this->endSection() ?>

<?php $this->section('content') ?>
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
        <li class="breadcrumb-item">User</li>
        <li class="breadcrumb-item active"><?= $isEditing ? 'edit' : 'create'?></li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block">
            <span class="js-get-date"></span>
        </li>
    </ol>
    <div class="subheader">
        <h1 class="subheader-title">
            <i class='subheader-icon fal fa-globe'></i> User
            <span class='fw-300'><?= $isEditing ? 'Edit' : 'Create'?></span>
        </h1>
    </div>
    <div class="row">
        <div class="col-12">
            <form
                    id="user-form"
                    class="<?= isset($errors) ? 'was-validated' : '' ?>"
                    action="<?= $isEditing ? "/user/$user[id]" : '/user/'?>"
                    method="POST">
                <div class="form-group row">
                    <?= $isEditing ? '<input type="hidden" name="_method" value="put" />' : '' ?>
                    <label class="col-xl-12 form-label" for="first_name">Your first and last name <small class="color-danger-900">*</small></label>
                    <div class="col-6 pr-1">
                        <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First Name" value="<?= $user['first_name'] ?? null ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="col-6 pl-1">
                        <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last Name" value="<?= $user['last_name'] ?? null ?>" required>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email <small class="color-danger-900">*</small></label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= $user['email'] ?? null ?>" required placeholder="Email">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="username">Username <small class="color-danger-900">*</small></label>
                    <input type="text" id="username" name="username" placeholder="Username" value="<?= $user['username'] ?? null ?>" required class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="mobile" >Mobile <small class="color-danger-900">*</small></label>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile" id="mobile" class="form-control" value="<?= $user['mobile'] ?? null ?>"  required placeholder="Mobile">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password <?= $isEditing ? '' : '<small class="color-danger-900">*</small>'?></label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="confirm_password">Confirm password  <?= $isEditing ? '' : '<small class="color-danger-900">*</small>'?></label>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                    <div class="invalid-feedback"></div>
                </div>
                <small>Fields with <small class="color-danger-900">*</small> are mandatory</small>
                <br>
                <button type="submit" class="btn btn-lg btn-primary">
                    <span class="fal fa-check mr-1"></span>
                    Save
                </button>
            </form>
        </div>
    </div>

<script>
    $(document).ready(function () {
        const errors = JSON.parse('<?= json_encode(session()->getFlashdata('data')['errors'] ?? '{}'); ?>');

        console.log(errors);
        if (Object.keys(errors).length > 0) {
            for (const key in errors) {
                const input = $(`[name='${key}']`);
                const inputGroup = input.parent();

                input.addClass('is-invalid');
                inputGroup.find('.invalid-feedback').html(errors[key]);

            }

            const allFormInputs = $('#user-form').find('.form-control');
            console.log(allFormInputs);
        }
    });


</script>
<?php $this->endSection() ?>