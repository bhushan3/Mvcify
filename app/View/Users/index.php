<div class='container'>
    <h1>/users</h1>
    <div class='box'>
        <table id='table-users'>
            <thead style='background-color: #ddd; font-weight: bold;'>
            <tr>
                <td>Id</td>
                <td>Name</td>
                <td>Location</td>
                <td>Email</td>
                <td>DELETE</td>
                <td>EDIT</td>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($this->users as $user) { ?>
                    <tr>
                        <td><?php echo isset($user->id) ? esc_html($user->id) : ''; ?></td>
                        <td><?php echo isset($user->name) ? esc_html($user->name) : ''; ?></td>
                        <td><?php echo isset($user->location) ? esc_html($user->location) : ''; ?></td>
                        <td><?php echo isset($user->email) ? esc_html($user->email) : ''; ?></td>
                        <td><a href='<?php echo SITE_URL . '/users/deleteuser/' . esc_html($user->id); ?>'>delete</a></td>
                        <td><a href='<?php echo SITE_URL . '/users/edituser/' . esc_html($user->id); ?>'>edit</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class='box'>
            <h3>Add New User</h3>
            <form id='form-add-new-user' action='<?php echo SITE_URL; ?>/users/register' method='POST'>
                <input id='user-name' type='text' name='name' placeholder='Name' required />
                <input id='user-location' type='text' name='location' placeholder='Location' required />
                <input id='user-email' type='text' name='email' placeholder='Email' required />
                <input type='submit' name='submit_add_user' value='Add' />
            </form>
        </div>
    </div>
</div>
