<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <br/>
            <h4 class="m-0 font-weight-bold text-primary text-center">Ubah Password</h4><hr/><br/>
            <div class="col-sm-10 offset-sm-1">
                <form action="<?= base_url('login/update_password');?>" method="POST" oninput='password2.setCustomValidity(password2.value != password1.value ? "Passwords do not match." : "")'>
                    <div class="row">
                        <div class="col-md-4">
                        <label>Current Password</label>
                            <input class="form-control" type="password" name="current_password" required>
                        </div>
                        <div class="col-md-4">
                        <label>New Password</label>
                            <input id="password1" class="form-control" type="password" name="new_password" required>
                        </div>
                        <div class="col-md-4">
                        <label>Confirm Password</label>
                            <input id="password2" class="form-control" type="password"  name="confirm_password">
                        </div>
                    </div><br/>
                    <div class="text-center">  
                        <input type="submit" value="Save" class="btn btn-primary"/>
                    </div>
                </form>
            </div><br/><br/>
        </div>
    </div>
    
</body>
</html>