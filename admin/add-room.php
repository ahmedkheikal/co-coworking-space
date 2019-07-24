<?php include 'header.php'; ?>
<?php include 'sidenav.php'; ?>
<div class="container">
    <div class="row">
        <form class="col s12" action="/api/add-room">
            <h2>Add room</h2>
            <div class="row">
                <div class="input-field col s12">
                    <input id="name" type="text" name="name" class="validate" required="" aria-required="true">
                    <label for="name">Name</label>
                </div>
                <div class="input-field col s12">
                    <textarea name="description" id="description" class="materialize-textarea validate" required="" aria-required="true"></textarea>
                    <label for="description">Room Description</label>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="capacity" type="number" name="capacity" class="validate" required="" aria-required="true">
                        <label for="capacity">Capacity</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="type">
                            <option value="" disabled selected>Choose your option</option>
                            <option value="Group">Group</option>
                            <option value="individual">Individual</option>
                        </select>
                        <label>Type</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input id="individual_price" type="number" name="individual_price" class="validate" required="" aria-required="true">
                        <label for="individual_price">Individual Price</label>
                    </div>
                    <div class="input-field col s6">
                        <input id="room_price" type="number" name="room_price" class="validate" required="" aria-required="true">
                        <label for="room_price">Room Price</label>
                    </div>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="add_room">
                Submit
            </button>
        </form>
    </div>

</div>
<?php include 'footer.php'; ?>

<script type="text/javascript">
$('form').submit(function (e) {
    e.preventDefault();
    $('#mainLoader').fadeIn('fast');
    $.ajax({
        url: 'api/add-room',
        method: 'POST',
        contentType: false,
        cache: false,
        processData: false,
        data: new FormData(this),
        success: function (data) {
            console.log(data);
            if (data.code == '200') {
                M.toast({html: 'Success!'})
                location.href = 'Rooms';
            } else {
                M.toast({html: data.response})
                $('#mainLoader').fadeOut('fast');
            }
        }
    })
})
M.textareaAutoResize($('#description'));
$('select').formSelect();

</script>
