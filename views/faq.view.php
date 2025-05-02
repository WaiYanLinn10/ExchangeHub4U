<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>

<header>
    <div  style="height: 52px; background-color: #A8D5E3;">
        <div class="container">
            <div class="row h-100 align-items-center">
                <div class="col-7 text-dark p-3">
                    <p class="d-inline p-2">
                        <a class="link-secondary color-1 text-decoration-none" href="/">Home</a><span> <?= $heading?></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</header>


<div class="container my-5">
    <div class="text-center my-5">
        <h1 class="text-uppercase color-1 fw-light">Frequently Asked</h1>
        <h1 class="d-inline border-bottom text-uppercase fw-light">Questions</h1>
    </div>

    <img src="images/faq_bundle.jpg" alt="" style="max-height:420px; object-fit:cover;" class="my-4 w-100 img-fluid">

    <div class="row my-5">
        <div class="col-md-8">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php $i=1; foreach($faqs as $faq){ ?>
                <div class="accordion-item mb-4 border-0">
                    <h2 class="accordion-header  id="faq-heading<?= $i;?>">
                    <button class="accordion-button faq-accordion collapsed px-0 py-3 border-bottom"" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse<?= $i;?>" aria-expanded="false" aria-controls="faq-collapse<?= $i;?>">
                        <?= $faq['faq_question'];?>
                    </button>
                    </h2>
                    <div id="faq-collapse<?= $i;?>" class="accordion-collapse collapse border-0" aria-labelledby="faq-heading<?= $i;?>" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body px-0">
                            <?= $faq['faq_answer'];?>
                        </div>
                    </div>
                </div>
                <?php $i++;} ?>
            </div>
        </div>
        

        <div class="col-md-4">
            <div class="card rounded-0 shadow-sm  border-0">
                <div class="card-body bg-dark bg-opacity-10 text-center p-5">
                    <h5 class="border-bottom border-dark border-1 pb-4 fw-normal">NEED MORE HELP?</h5>
                    <div class="row mt-4">
                        <div class="col-sm-6">
                            <i class="fa-solid fa-paper-plane d-block fs-1 mb-2"></i>
                            <a href="/contact" class="link-dark">Contact Us</a>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa-solid fa-circle-question d-block fs-1 mb-2"></i>
                            <button id="askQuestionBtn" class="link-dark text-decoration-underline btn border-0 p-0">Ask Question</button>
                        </div>
                    </div>
                    <div id="questionBox">

                    </div>
                    <!-- <form action="" class="text-start">
                        <label for="" class="mb-2 mt-4 fw-semibold">Your question</label>
                        <textarea name="question" id="" class="form-control rounded-0" rows="4" placeholder="What do you want to know about . . ."></textarea>
                        <button class="btn btn-success rounded-0 px-3 float-end mt-3">Submit</button>
                    </form> -->
                </div>
            </div>
        </div>
    </div>
    
</div>

<script>
let btn = document.getElementById('askQuestionBtn');
let div = document.getElementById('questionBox');

btn.addEventListener('click',function(){
    if(!div.classList.contains('opened-question-form')){

        div.classList.add('opened-question-form');

        let form = document.createElement('form');
        form.id='questionForm';
        form.action="addQuestion.php";
        form.method="POST";
        div.append(form);


        let qLabel = document.createElement('label');
        qLabel.textContent = 'Your questions';
        qLabel.classList.add('mb-2','mt-4','fw-semibold');
        document.getElementById('questionForm').append(qLabel);

        let question = document.createElement('textarea');
        question.classList.add('form-control','rounded-0');
        question.rows = '4';
        question.name='question';
        question.placeholder = "What do you want to know about . . .";
        question.required = true;
        document.getElementById('questionForm').append(question);


        let submitquestionBtn = document.createElement('button');
        submitquestionBtn.classList.add('btn','btn-success', 'rounded-0', 'px-3', 'float-end','mt-3');
        submitquestionBtn.type = 'submit';
        submitquestionBtn.innerText='Submit';
        document.getElementById('questionForm').append(submitquestionBtn);


    } else {
        div.innerHTML="";
        div.classList.remove('opened-question-form');
    }
});

 
</script>




<?php require('partials/footer.php') ?>