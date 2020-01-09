
<style>
 body {
    margin-top:30px;
}
.stepwizard-step p {
    margin-top: 0px;
    color:#666;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}
.stepwizard-step button[disabled] {
    /*opacity: 1 !important;
    filter: alpha(opacity=100) !important;*/
}
.stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
    opacity:1 !important;
    color:#bbb;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content:" ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-index: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>


<html>
<head>
<link rel="stylesheet" href="/css/app.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    <div class="container">

    Demande Envoyer
        <!-- <form role="form" action="" method="post">
        @csrf
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Date de naissance</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Adresse</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Info</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Permis</small></p>
            </div>
            
        </div>
    </div>
    
    
        <div class="panel panel-primary setup-content" id="step-1">
        <div class="panel-heading">
                 <h3 class="panel-title">You need your info carefully</h3>
            </div>      
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">CIN</label>
                    <input maxlength="200" name="cin" type="text" required="required" class="form-control" placeholder="Cin" />
                </div>

                <div class="form-group">
                    <label class="control-label">Name</label>
                    <input maxlength="200" name="name" type="text" required="required" class="form-control" placeholder="Nom" />
                </div>

                

                <div class="form-group">
                    <label class="control-label">num tel</label>
                    <input maxlength="200" name="numtel" type="text" required="required" class="form-control" placeholder="Num tel" />
                </div>

                <div class="form-group">                           
                            <select name="type"  id="type"
                                class="form-control" >
                                    <option value="">Choisir type de travaille</option>
                                    <option value="Controlleur">Controlleur</option>
                                     <option value="Chauffeur">Chauffeur</option>
                                      <option value="Controlleur">Receveur</option>
                            </select>
                           
                        </div>

                
               
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Adresse</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Adresse</label>
                    <input maxlength="200" type="text" required="required" class="form-control" placeholder="Adreesse" />
                </div>
               
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>


        <div class="panel panel-primary setup-content" id="step-3">
        <div class="panel-heading">
                 <h3 class="panel-title">Date de Naissance</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="control-label">Date</label>
                    <input maxlength="100" type="date" required="required" class="form-control" placeholder="Enter First Name" />
                </div>
               
                <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
            </div>
        </div>
        
        
       
            <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Permis</h3>
            </div>
            <div class="panel-body">
               
                <div class="form-group">
                    <label class="control-label">Vous Avez un permid de bus</label>
                    <label>
                <input name="group1" type="radio" checked />
                <span>Oui</span>
                </label>

                <input name="group1" type="radio"  />
                <span>Non</span>
                </label>
                        </div>
                <button class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
        </form> -->
</div>

</body>
</html>

<script src="/js/app.js"></script>
<script>

// $(document).ready(function () {

// var navListItems = $('div.setup-panel div a'),
//     allWells = $('.setup-content'),
//     allNextBtn = $('.nextBtn');

// allWells.hide();

// navListItems.click(function (e) {
//     e.preventDefault();
//     var $target = $($(this).attr('href')),
//         $item = $(this);

//     if (!$item.hasClass('disabled')) {
//         navListItems.removeClass('btn-success').addClass('btn-default');
//         $item.addClass('btn-success');
//         allWells.hide();
//         $target.show();
//         $target.find('input:eq(0)').focus();
//     }
// });

// allNextBtn.click(function () {
//     var curStep = $(this).closest(".setup-content"),
//         curStepBtn = curStep.attr("id"),
//         nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
//         curInputs = curStep.find("input[type='text'],input[type='url']"),
//         isValid = true;

//     $(".form-group").removeClass("has-error");
//     for (var i = 0; i < curInputs.length; i++) {
//         if (!curInputs[i].validity.valid) {
//             isValid = false;
//             $(curInputs[i]).closest(".form-group").addClass("has-error");
//         }
//     }

//     if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
// });

// $('div.setup-panel div a.btn-success').trigger('click');
// });

</script>