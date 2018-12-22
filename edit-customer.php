<?php include 'header.php'; ?>
<?php include 'sidenav.php'; ?>
<?php
    $customer_q = mysqli_query($con, "SELECT * FROM customers WHERE id = '". secure($_GET['id']) ."'");
    if (mysqli_num_rows($customer_q))
    $customer = mysqli_fetch_assoc($customer_q);
    else
    header('location: 404');
 ?>
<div class="container">
    <div class="row">
        <form class="col s12" action="/api/edit-customer">
            <h2>Add Customer</h2>
            <div class="row">
                <input type="hidden" name="id" value="<?php echo $customer['id'] ?>">
                <div class="input-field col s6">
                    <input id="first_name" name="first_name" type="text" class="validate" required="" aria-required="true" value="<?php echo $customer['first_name'] ?>">
                    <label for="first_name">First Name</label>
                </div>
                <div class="input-field col s6">
                    <input id="last_name" name="last_name" type="text" class="validate" required="" aria-required="true" value="<?php echo $customer['last_name'] ?>">
                    <label for="last_name">Last Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="phone" name="phone" type="tel" class="validate" required="" aria-required="true" value="<?php echo $customer['phone'] ?>">
                    <label for="phone">Phone</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="email" type="email" name="email" class="validate" required="" aria-required="true" value="<?php echo $customer['email'] ?>">
                    <label for="email">Email</label>
                </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="add_customer">
                Edit
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
            url: 'api/edit-customer',
            method: 'POST',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function (data) {
                console.log(data);
                if (data.code == '200') {
                    M.toast({html: 'Success!'})
                    location.href = 'Customers';
                } else {
                    M.toast({html: data.response})
                    $('#mainLoader').fadeOut('fast');
                }
            }
        })
    })
</script>
