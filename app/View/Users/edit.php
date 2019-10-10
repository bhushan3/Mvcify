<div class='container'>
    <h2>/users/edituser</h2>
    <div>
        <h3>Update user</h3>
        <form id='form-edit-user' method='POST' action='<?php echo SITE_URL; ?>/users/edituser/<?php echo esc_html($this->user->id); ?>'>
            <input autofocus type='text' name='name' value='<?php echo esc_html($this->user->name); ?>' required />
            <input type='text' name='location' value='<?php echo esc_html($this->user->location); ?>' required />
            <input type='text' name='email' value='<?php echo esc_html($this->user->email); ?>' />
            <input type='submit' name='submit_edit_user' value='Update' />
        </form>
    </div>
</div>
