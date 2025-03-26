<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<header>
    <div  style="height: 52px; background-color: #efaa083e;">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-7 text-dark p-3">
                    <p class="d-inline p-2">
                        <a class="link-secondary color-1 text-decoration-none" href="/">Home</a><span> - Contact Us</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>

<main>

<div class="container">
    <div class="row h-100 align-items-center">
        <div class="col-md-12 text-dark p-3">
            <h3 class="text-center">Contact Us For More Information</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <p>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est quasi harum ullam obcaecati minus omnis illum assumenda! Nesciunt hic deleniti, sequi debitis, quod possimus atque labore enim tenetur officia esse.
            </p>
        </div>
        <div class="col-md-2"></div>
    </div>

</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-8">
            <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d496115.4596391787!2d100.30343366556363!3d13.724380945381625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x311d6032280d61f3%3A0x10100b25de24820!2sBangkok!5e0!3m2!1sen!2sth!4v1741896201292!5m2!1sen!2sth"
            width="600"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</div>
    
<hr class="my-5 border-warning border border-1">

<div class="container my-5">
    <div class="row">
        <div class="col-md-4">
            <h3 class="text-uppercase text-center">Address</h3>
            <p class="mt-4"></p>
        </div>
        <div class="col-md-4">
            <h3 class="text-uppercase text-center">Contact</h3>
            <p class="mt-4"></p>
        </div>
        <div class="col-md-4">
            <h3 class="text-uppercase text-center">Live Chat Operation</h3>
            <p class="mt-4 text-center">
                Monday & Friday 08:30 - 18:00 <br>
                Saturday & Sunday 09:00 - 18:00
            </p>
        </div>  
    </div>
    <br><br>

    <h3 class="text-center">
        Send a message
        <form action="contactusEmail.php" method="POST">
            <div class="row my-3 mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-3">
                    <input type="text" class="form-control rounded-0" placeholder="NAME" name="name">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control rounded-0" placeholder="EMAIL" name="email">
                </div>
            </div>
            <div class="row my-3 mt-2">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <textarea name="message" rows="5" class="form-control rounded-0" placeholder="MESSAGE"></textarea>
                </div>
            </div>
            <button type="submit" class="rounded-0 secondary-btn btn mt-2 px-4 py-2">SUBMIT</button>
        </form>
    </h3>
</div>



</main>

<?php require('partials/footer.php') ?>
