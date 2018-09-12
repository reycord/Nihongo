<style>
    .exTab3 .nav-pills > li > a {
      border-radius: 4px 4px 0 0 ;
    }
    
    .exTab3 .tab-content {
      color : black;
      background-color: #dbe6f1;
      padding : 5px 15px;
    }
    
    .nav-pills>li>a {
        color : black;
    }
    
    .exTab3 .nav-pills > li > a {
        border: 1px solid #e4e4e4;
    }
    
    .exTab3 > ul {
        border: 1px solid #e4e4e4;
    }
    
    #exTab1 > ul > li {
        font-weight: bold;
    }
    
    .td_radio {
        border: 1px solid #e4e4e4;
        padding: 5px;
    }
</style>

<div class="container" id="main-content"> 
    <div class="col-sm-9 col-xs-9" style="margin:0 auto; float: left; margin-top: 10px;">
        <form id="testing_form" style="height: 70px;" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="col-xs-12" style="border: 1px solid #e4e4e4; padding:10px;">
                <div>     
                    <table style="width: 100%;">
                        <tr>
                            <td style="padding-left: 15px;">Level</td>
                            <td style="padding-bottom: 2px; padding-top: 2px; display: inline-flex; width: 50px;">
                                <select style="height: 25px; padding: 1px;" id="chooseLevel" name="chooseLevel" 
                                class="form-control input-sm" >
                                    <?php for($i = 5; $i >= 1; $i--): ?>
                                        <option value="<?php echo $i; ?>" <?php if(isset($data['chooseLevel']) && $data['chooseLevel'] == $i): ?> selected <?php endif ?> >
                                            N<?php echo $i ?>
                                        </option>
                                    <?php endfor ?>                             
                                </select>
                            </td>
                            
                            <td style="padding-left: 30px; ">Bài học</td>               
                            <td style="padding-bottom: 2px;padding-top: 2px; display: inline-flex;">
                                <select style="width: 70px; height: 25px; padding: 1px;" id="chooseExamCode" name="chooseExamCode" 
                                class="form-control input-sm" >
                                    <?php for($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php if(isset($data['chooseExamCode']) && $data['chooseExamCode'] == $i): ?> selected <?php endif ?> >
                                            Đề <?php echo $i ?>
                                        </option>
                                    <?php endfor ?>                            
                                </select>
                            </td>
                            
                            <td style="width: 90px;">
                                <button class="btn btn-info" type="submit" name="submit" value="trial_test" id="trial_test" >THI THỬ</button>
                            </td>            
                        </tr>
                     </table>
                 </div>
            </div>
      </form> 
    </div>
    
    <div class="col-sm-3 col-xs-3" style="float: right;">
        <button id="submit_test" onclick="check_testing()" class="btn btn-primary" style="width: 100%; margin-top: 10px; height: 55px; font-size: 24px;">NỘP BÀI</button>
    </div>
    
    <div class="col-sm-9 col-xs-9" style="float: left;">
        <?php $totalMondai = 1; ?>
        <div id="exTab1" class="exTab3">
            <?php if(isset($data['listItem'])): ?>
            <ul  class="nav nav-pills">
                <?php foreach ($data['listItem'] as $key => $value): ?>
                    <?php if($key == 0): ?>
                        <li class="active"><a  href="#<?php echo ($key + 1); ?>a" data-toggle="tab"><?php echo $value['type_content'] ?></a>
                        </li>
                    <?php else: ?>
                        <li><a  href="#<?php echo ($key + 1); ?>a" data-toggle="tab"><?php echo $value['type_content'] ?></a>
                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            </ul>
            
            <div class="tab-content clearfix">
                <?php foreach ($data['listItem'] as $key => $value): ?>
                    <?php if($key == 0): ?>
                    <div class="tab-pane active" id="<?php echo ($key + 1); ?>a">
                    <?php else: ?>
                    <div class="tab-pane" id="<?php echo ($key + 1); ?>a">
                    <?php endif ?>
                        <div id="exTab<?php echo ($key + 2); ?>" class="exTab3"> 
                            <ul  class="nav nav-pills">
                                <?php foreach ($data['listMondai'] as $keySub => $valueSub): ?>
                                    <?php if($key == $keySub): ?>
                                        <?php for($i_valueSub = 0; $i_valueSub < $valueSub['result']; $i_valueSub++): ?>
                                            <?php $href_temp = "#" . ($key + 1) . "a" . ($i_valueSub + 1); ?>
                                            <?php if($i_valueSub == 0): ?>
                                                <li id="<?php echo $href_temp; ?>1" class="active"><a  href="<?php echo $href_temp; ?>" data-toggle="tab">問題<?php echo ($i_valueSub + 1); ?></a>
                                                </li>
                                            <?php else: ?>
                                                <li id="<?php echo $href_temp; ?>1"><a  href="<?php echo $href_temp; ?>" data-toggle="tab">問題<?php echo ($i_valueSub + 1); ?></a>
                                                </li>
                                            <?php endif ?>
                                        <?php endfor ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </ul>
                            
                            <div class="tab-content clearfix">
                                <?php foreach ($data['listMondai'] as $keySub => $valueSub): ?>
                                    <?php if($key == $keySub): ?>
                                        <?php for($i_valueSub = 0; $i_valueSub < $valueSub['result']; $i_valueSub++): ?>
                                            <?php $href_temp = ($keySub + 1) . "a" . ($i_valueSub + 1); ?>
                                            <?php if($key == 0): ?>
                                            <div class="tab-pane active" id="<?php echo $href_temp; ?>">
                                            <?php else: ?>
                                            <div class="tab-pane" id="<?php echo $href_temp; ?>">
                                            <?php endif ?>
                                                <div form="testing_form" style="border: 1px solid #ccc; height: 375px; padding: 15px; overflow: scroll;">
                                                    <?php foreach ($data['listQuestion'] as $key => $row): ?>
                                                        <?php if(($i_valueSub + 1) == $row['mondai'] && ($keySub + 1) == $row['type_id']): ?>
                                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($row['number']) . ":"; ?></span>
                                                                <?php echo (" " . $row['question1'] . " "); ?>
                                                                <span style="font-weight: bold; text-decoration: underline;"><?php echo $row['question2']; ?></span>
                                                                <?php echo " " . $row['question3'] ?>
                                                            </h6>
                                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($row['answer1']) ?></p>
                                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($row['answer2']) ?></p>
                                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ($row['answer3']) ?></p>
                                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ($row['answer4']) ?></p>
                                                            <br />
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        <?php endfor ?>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <?php endif ?>
        </div>
    </div>
    
    <div class="col-sm-3 col-xs-3" style="float: right;">
        <div style="border: 1px solid #ccc; width: 100%; height: 455px;">
            <div style="height: 30px;">
                <p style="color: red; text-decoration: bold; padding: 10px 5px 5px 5px; width: 50%; float: left;" id="title_answer">
                    <?php if(isset($data['listQuestion'])): ?>Phần trả lời<?php endif ?></p>
                <p style="width: 50%; font-size: 25px; float: right; padding-right: 5px; padding-top: 5px;text-align: right; height: 100%;" id="correct_answer"></p>
            </div>

            <div style="overflow: auto; height: 415px; width: 100%;">
            <?php if(isset($data['listQuestion'])): ?>
                <form name="radio_form">
                    <?php foreach ($data['listItem'] as $type_key => $type_value): ?>
                        <?php foreach ($data['listMondai'] as $mondai_key => $mondai_value): ?>
                            <?php if($type_key == $mondai_key): ?>
                                <?php for($i = 1; $i <= $mondai_value['result']; $i++): ?>
                                    <?php if($type_key == 0 && $mondai_key == 0 && $i == 1): ?>
                                    <table style="width: 100%;" id="chooseAnswer<?php echo $totalMondai++; ?>">
                                    <?php else: ?>
                                    <table style="width: 100%; display: none;" id="chooseAnswer<?php echo $totalMondai++; ?>">
                                    <?php endif ?>
                                        <?php foreach ($data['listQuestion'] as $key => $row): ?>
                                            <?php if($row['type_id'] == $type_value['type_id'] && $row['mondai'] == $i): ?>
                                                <tr style="border: 1px solid #e4e4e4;">
                                                    <td style="text-align: center; border: 1px solid #e4e4e4;"><?php echo ($row['number']); $group_name = "ques" . $row['number']; ?></td>
                                                    <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="<?php echo $row['answer1']; ?>"> A</td>
                                                    <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="<?php echo $row['answer2']; ?>"> B</td>
                                                    <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="<?php echo $row['answer3']; ?>"> C</td>
                                                    <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="<?php echo $row['answer4']; ?>"> D</td>
                                                </tr>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </table>
                                <?php endfor ?>
                            <?php endif ?>
                        <?php endforeach ?>
                    <?php endforeach ?>
                </form>
            <?php endif ?>
            </div>
        </div>
    </div>
</div>

<script>
    var listQuestion_result = [];
    var listMondai = [];
    var counter;
    var countQuestion = 0;
    var totalType = 0;
    var totalMondai = 1;
    
    $(document).ready(function() {
        <?php if(isset($data['listQuestion'])): ?>
            <?php foreach ($data['listQuestion'] as $key => $row): ?>
                listQuestion_result.push("<?php echo $row['answer_correct']; ?>");
                countQuestion++;
            <?php endforeach ?>
            
            <?php foreach ($data['listItem'] as $key => $value): ?>
                totalType += 1;
            <?php endforeach ?>
            
            <?php foreach ($data['listMondai'] as $keySub => $valueSub): ?>
                listMondai.push(<?php echo $valueSub['result']; ?>);
            <?php endforeach ?>
            
            timeCounter(1);
        <?php endif ?>
    });
    
    function handleElement() {
       for (var o=1; o <= totalType; o++) {
            for(var i=0; i < listMondai.length; i++){
                if(o == (i + 1)){
                    for(var l = 1; l <= listMondai[i]; l++){
                        var temp = "#" + o + "a" + l + "1";
                        console.log("out: " + temp + ", " + listMondai[i]);
    
                        $(temp).on('click',function(){
                           console.log("on: " + temp + ", " + l);
                            var el10 = $('#chooseAnswer' + l);
                            
                            for (var k=1; k <= totalMondai; k++) {
                                el10.removeAttr('style');
                                if(l == k){
                                    el10.attr('style', 'width: 100%;');
                                } else {
                                    el10.attr('style', 'width: 100%; display: none;');
                                }
                            }
                        }); 
                    }
                }
            };
        };
    }
    
    function hasClass(element, cls) {
        return (' ' + element.className + ' ').indexOf(' ' + cls + ' ') > -1;
    }
    
    $(function(){
        $("#chooseLesson").chained("#chooseLevel");
    });
    
    function startTimer(duration, display) {
        timer = duration
        var minutes, seconds;
        counter = setInterval(function () {
            minutes = parseInt(timer / 60, 10);
            seconds = parseInt(timer % 60, 10);
    
            minutes = minutes < 10 ? "0" + minutes : minutes;
            seconds = seconds < 10 ? "0" + seconds : seconds;
    
            // console.log(minutes + ":" + seconds);
            display.textContent = minutes + ":" + seconds;
    
            if(minutes == 0 && seconds == 0) {
                $("#submit_test").click();
            }
            
            if (--timer < 0) {
                timer = duration;
            }
        }, 1000);
    }
    
    function removePTimer(){
        clearInterval(counter);
    }
    
    function timeCounter(minute){
        var fiveMinutes = 60 * minute,
            display = document.querySelector('#correct_answer');
        startTimer(fiveMinutes, display);
    }
 </script>