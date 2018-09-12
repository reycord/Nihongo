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

    /*input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: white;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid black;
    }
    
    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #ffa500;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }*/
</style>

<div class="container"> 
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
                                <?php foreach ($data['listLevel'] as $key => $row): ?>
                                    <option value="<?php echo $row['certificate_id'] ?>"
                                        <?php if(isset($data['chooseLevel']) && $data['chooseLevel'] == $row['certificate_id']): ?> selected <?php endif ?> >
                                    <?php echo $row['certificate_title']?>
                                    </option>
                                <?php endforeach ?>                            
                            </select>
                        </td>
                        
                        <td style="padding-left: 30px; ">Bài học</td>               
                        <td style="padding-bottom: 2px;padding-top: 2px; display: inline-flex;">
                            <select style="width: 220px; height: 25px; padding: 1px;" id="chooseLesson" name="chooseLesson" 
                            class="form-control input-sm" >
                                <?php foreach ($data['listLesson'] as $key => $row): ?>
                                    <option value="<?php echo $row['lesson_id'] ?>" class="<?php echo $row['lesson_level'] ?>" 
                                        <?php if(isset($data['chooseLesson']) && $data['chooseLesson'] == $row['lesson_id']): ?> selected <?php endif ?>
                                        title="<?php echo "Lesson " . $row['lesson_id'] . " - " . $row['lesson_title'] ?>" >
                                    <?php echo "Lesson " . $row['lesson_id'] . " - " . $row['lesson_title'] ?>    
                                    </option>
                                    <?php echo $row['certificate_title']?>
                                <?php endforeach ?>                            
                            </select>
                        </td>
                        
                        <td style="width: 90px;">
                            <button class="btn btn-info" type="submit" name="submit" value="study" id="study" >HỌC LẠI</button>
                        </td>
                        
                        <td style="width: 90px;">
                            <button class="btn btn-info" type="submit" name="submit" value="test" id="test" >KIỂM TRA</button>
                        </td>            
                    </tr>
                 </table>
             </div>
              
              <div class="" id="message_user_div" style="float: left; width: 98%;">
                <div id="message_div_error" <?php if ($data['success'] == true): ?> style="display: none; padding: 5px;" <?php endif ?> 
                    id="error_div"class="alert alert-warning alert-dismissible  " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <strong>エラー： </strong>
                    <span id="message"><?php echo $data['message'] ?></span>
                </div>
                
                <?php if ($data['success'] == true && $data['message'] != ""): ?>
                    <div id="success_div"class="alert alert-success alert-dismissible " role="alert" style="padding: 5px;">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong>アラーム： </strong> <?php echo $data['message'] ?>
                    </div>
                <?php endif ?>
            </div>
        </div>
  </form> 
</div>

<div class="col-sm-3 col-xs-3" style="float: right;">
    <button id="submit_test" onclick="check_testing()" class="btn btn-primary" style="width: 100%; margin-top: 10px; height: 55px; font-size: 24px;">NỘP BÀI</button>
</div>

<div class="col-sm-9 col-xs-9" style="float: left;">
    <div id="exTab1" class="exTab3">
        <ul  class="nav nav-pills">
            <li class="active"><a  href="#1a" data-toggle="tab">Từ vựng</a>
            </li>
            <li><a  href="#3a" data-toggle="tab">Ngữ pháp</a>
            </li>
        </ul>
        
        <div class="tab-content clearfix">
            <div class="tab-pane active" id="1a">
                <div id="exTab2" class="exTab3"> 
                    <ul  class="nav nav-pills">
                        <li id="2a1" class="active"><a  href="#1a1" data-toggle="tab">JP - VN</a>
                        </li>
                        <li id="2a2"><a href="#1a2" data-toggle="tab">VN - JP</a>
                        </li>
                        <li id="2a3"><a href="#1a3" data-toggle="tab">Kanji - JP</a>
                        </li>
                    </ul>
                
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="1a1">
                            <!-- JP - VN -->
                            <div form="testing_form" style="border: 1px solid #ccc; height: 375px; padding: 15px; overflow: scroll;">
                                <?php if(isset($data['listVocab'])): ?>
                                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                                        <?php 
                                            $dice1 = rand(0, count($data['listVocab']) - 1);
                                            while($dice1 == $key){
                                                $dice1 = rand(1, count($data['listVocab']) - 1);
                                            };
                                            
                                            $dice2 = rand(0, count($data['listVocab']) - 1);
                                            while($dice2 == $key || $dice2 == $dice1){
                                                $dice2 = rand(1, count($data['listVocab']) - 1);
                                            };
                                            
                                            $dice3 = rand(0, count($data['listVocab']) - 1);
                                            while($dice3 == $key || $dice3 == $dice1 || $dice3 == $dice2){
                                                $dice3 = rand(1, count($data['listVocab']) - 1);
                                            };
                                        ?>
                                        <?php if($data['listVocab_result'][$key] == 1): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . $row['vocabulary_word'] ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'a. ' ?></span><?php echo ucfirst($row['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ucfirst($data['listVocab'][$dice1]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ucfirst($data['listVocab'][$dice2]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ucfirst($data['listVocab'][$dice3]['vocabulary_mean']) ?></p>
                                            <br />
                                        <?php elseif($data['listVocab_result'][$key] == 2): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . $row['vocabulary_word'] ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ucfirst($data['listVocab'][$dice1]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'b. ' ?></span><?php echo ucfirst($row['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ucfirst($data['listVocab'][$dice2]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ucfirst($data['listVocab'][$dice3]['vocabulary_mean']) ?></p>
                                            <br />
                                        <?php elseif($data['listVocab_result'][$key] == 3): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . $row['vocabulary_word'] ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ucfirst($data['listVocab'][$dice1]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ucfirst($data['listVocab'][$dice2]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'c. ' ?></span><?php echo ucfirst($row['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ucfirst($data['listVocab'][$dice3]['vocabulary_mean']) ?></p>
                                            <br />
                                        <?php else: ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . $row['vocabulary_word'] ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ucfirst($data['listVocab'][$dice1]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ucfirst($data['listVocab'][$dice2]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ucfirst($data['listVocab'][$dice3]['vocabulary_mean']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'd. ' ?></span><?php echo ucfirst($row['vocabulary_mean']) ?></p>
                                            <br />
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="1a2">
                            <!-- VN - JP -->
                            <div form="testing_form" style="border: 1px solid #ccc; height: 375px; padding: 15px; overflow: scroll;">
                                <?php if(isset($data['listVocab'])): ?>
                                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                                        <?php 
                                            $dice1 = rand(0, count($data['listVocab']) - 1);
                                            while($dice1 == $key){
                                                $dice1 = rand(1, count($data['listVocab']) - 1);
                                            };
                                            
                                            $dice2 = rand(0, count($data['listVocab']) - 1);
                                            while($dice2 == $key || $dice2 == $dice1){
                                                $dice2 = rand(1, count($data['listVocab']) - 1);
                                            };
                                            
                                            $dice3 = rand(0, count($data['listVocab']) - 1);
                                            while($dice3 == $key || $dice3 == $dice1 || $dice3 == $dice2){
                                                $dice3 = rand(1, count($data['listVocab']) - 1);
                                            };
                                        ?>
                                        <?php if($data['listVocab1_result'][$key] == 1): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . ucfirst($row['vocabulary_mean']) ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'a. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                            <br />
                                        <?php elseif($data['listVocab1_result'][$key] == 2): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . ucfirst($row['vocabulary_mean']) ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'b. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                            <br />
                                        <?php elseif($data['listVocab1_result'][$key] == 3): ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . ucfirst($row['vocabulary_mean']) ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'c. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                            <br />
                                        <?php else: ?>
                                            <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($key + 1) . ":" ?></span><?php echo " " . ucfirst($row['vocabulary_mean']) ?></h6>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                            <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'd. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                            <br />
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="1a3">
                            <!-- Kanji - JP -->
                            <div form="testing_form" style="border: 1px solid #ccc; height: 375px; padding: 15px; overflow: scroll;">
                                <?php if(isset($data['listVocab'])): ?>
                                    <?php $kanji_index = 1 ?>
                                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                                        <?php if($row['vocabulary_kanji'] != null): ?>
                                            <?php
                                                $dice1 = rand(0, count($data['listVocab']) - 1);
                                                while($dice1 == $key){
                                                    $dice1 = rand(1, count($data['listVocab']) - 1);
                                                };
                                                
                                                $dice2 = rand(0, count($data['listVocab']) - 1);
                                                while($dice2 == $key || $dice2 == $dice1){
                                                    $dice2 = rand(1, count($data['listVocab']) - 1);
                                                };
                                                
                                                $dice3 = rand(0, count($data['listVocab']) - 1);
                                                while($dice3 == $key || $dice3 == $dice1 || $dice3 == $dice2){
                                                    $dice3 = rand(1, count($data['listVocab']) - 1);
                                                };
                                            ?>
                                            <?php if($data['listVocab2_result'][$key] == 1): ?>
                                                <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($kanji_index) . ":" ?></span><?php echo " " . $row['vocabulary_kanji'] ?></h6>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'a. ' ?></span><?php echo $row['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo $data['listVocab'][$dice1]['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo $data['listVocab'][$dice2]['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo $data['listVocab'][$dice3]['vocabulary_word'] ?></p>
                                                <br />
                                            <?php elseif($data['listVocab2_result'][$key] == 2): ?>
                                                <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($kanji_index) . ":" ?></span><?php echo " " . $row['vocabulary_kanji'] ?></h6>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo $data['listVocab'][$dice1]['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'b. ' ?></span><?php echo $row['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo $data['listVocab'][$dice2]['vocabulary_word'] ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo $data['listVocab'][$dice3]['vocabulary_word'] ?></p>
                                                <br />
                                            <?php elseif($data['listVocab2_result'][$key] == 3): ?>
                                                <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($kanji_index) . ":" ?></span><?php echo " " . $row['vocabulary_kanji'] ?></h6>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'c. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "d. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                                <br />
                                            <?php else: ?>
                                                <h6><span style="font-weight: bold; text-decoration: underline;"><?php echo "Câu " . ($kanji_index) . ":" ?></span><?php echo " " . $row['vocabulary_kanji'] ?></h6>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "a. " ?></span><?php echo ($data['listVocab'][$dice1]['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "b. " ?></span><?php echo ($data['listVocab'][$dice2]['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo "c. " ?></span><?php echo ($data['listVocab'][$dice3]['vocabulary_word']) ?></p>
                                                <p><span style="font-weight: bold; padding-left: 15px;"><?php echo 'd. ' ?></span><?php echo ($row['vocabulary_word']) ?></p>
                                                <br />
                                            <?php endif ?>
                                            <?php $kanji_index++; ?>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="3a">
                <div id="exTab3" class="exTab3"> 
                    <ul  class="nav nav-pills">
                        <li class="active"><a  href="#3a1" data-toggle="tab">Type A</a>
                        </li>
                        <li><a href="#3a2" data-toggle="tab">Type B</a>
                        </li>
                    </ul>
                
                    <div class="tab-content clearfix">
                        <div class="tab-pane active" id="3a1" style="height: 375px;">
                            <h3>Type AAA</h3>
                        </div>
                        <div class="tab-pane" id="3a2" style="height: 375px;">
                            <h3>Type BBB</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-3 col-xs-3" style="float: right;">
    <div style="border: 1px solid #ccc; width: 100%; height: 455px;">
        <div style="height: 30px;">
            <p style="color: red; text-decoration: bold; padding: 10px 5px 5px 5px; width: 50%; float: left;" id="title_answer">
                <?php if(isset($data['listVocab'])): ?>Phần trả lời<?php endif ?></p>
            <p style="width: 50%; font-size: 25px; float: right; padding-right: 5px; padding-top: 5px;text-align: right; height: 100%;" id="correct_answer"></p>
        </div>
        <div style="overflow: auto; height: 415px; width: 100%;">
        <?php if(isset($data['listVocab'])): ?>
            <form name="radio_form">
                <table style="width: 100%;" id="chooseAnswer">
                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                        <tr style="border: 1px solid #e4e4e4;">
                            <td style="text-align: center; border: 1px solid #e4e4e4;"><?php echo ($key + 1); $group_name = "ques0" . $key; ?></td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="1"> A</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="2"> B</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="3"> C</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="4"> D</td>
                        </tr>
                    <?php endforeach ?>
                </table>
                <table style="width: 100%; display:none;" id="chooseAnswer1">
                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                        <tr style="border: 1px solid #e4e4e4;">
                            <td style="text-align: center; border: 1px solid #e4e4e4;"><?php echo ($key + 1); $group_name = "ques1" . $key; ?></td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="1"> A</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="2"> B</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="3"> C</td>
                            <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="4"> D</td>
                        </tr>
                    <?php endforeach ?>
                </table>
                <table style="width: 100%; display:none;" id="chooseAnswer2">
                    <?php $index_kanji = 1; ?>
                    <?php foreach ($data['listVocab'] as $key => $row): ?>
                        <?php if($row['vocabulary_kanji'] != null): ?>
                            <tr style="border: 1px solid #e4e4e4;">
                                <td style="text-align: center; border: 1px solid #e4e4e4;"><?php echo ($index_kanji); $group_name = "ques2" . $key; ?></td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="1"> A</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="2"> B</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="3"> C</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="4"> D</td>
                            </tr>
                            <?php $index_kanji++; ?>
                        <?php else: ?>
                            <tr style="border: 1px solid #e4e4e4; display:none;">
                                <td style="text-align: center; border: 1px solid #e4e4e4;"><?php echo ($key + 1); $group_name = "ques2" . $key; ?></td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="1"> A</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="2"> B</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="3"> C</td>
                                <td class="td_radio" name="td_id" ><input type="radio" name="<?php echo $group_name ?>" id="<?php echo $group_name ?>" value="4"> D</td>
                            </tr>
                        <?php endif ?>
                    <?php endforeach ?>
                </table>
            </form>
        <?php endif ?>
        </div>
    </div>
</div>
</div>

<script>
    var listVocab_result = [];
    var listVocab1_result = [];
    var listVocab2_result = [];
    var counter;
    var countQuestion = 0;
    
    $( document ).ready(function() {
        <?php if(isset($data['listVocab_result'])): ?>
            <?php foreach ($data['listVocab_result'] as $key => $row): ?>
                listVocab_result.push(<?php echo $row; ?>);
                countQuestion++;
            <?php endforeach ?>
            
            <?php foreach ($data['listVocab1_result'] as $key => $row): ?>
                listVocab1_result.push(<?php echo $row; ?>);
                countQuestion++;
            <?php endforeach ?>
            
            <?php foreach ($data['listVocab2_result'] as $key => $row): ?>
                listVocab2_result.push(<?php echo $row; ?>);
                <?php if($row != null): ?>
                    countQuestion++;
                <?php endif ?>
            <?php endforeach ?>
            
            timeCounter(countQuestion / 2);
        <?php endif ?>
    });
    
    $('#2a1').on('click',function(){
        var el10 = $('#chooseAnswer');
        var el11 = $('#chooseAnswer1');
        var el12 = $('#chooseAnswer2');
        
        el10.removeAttr('style');
        el10.attr('style', 'width: 100%;');
        
        el11.removeAttr('style');
        el11.attr('style', 'width: 100%; display: none;');
        
        el12.removeAttr('style');
        el12.attr('style', 'width: 100%; display: none;');
    });
    
    $('#2a2').on('click',function(){
        var el11 = $('#chooseAnswer');
        var el10 = $('#chooseAnswer1');
        var el12 = $('#chooseAnswer2');
        
        el11.removeAttr('style');
        el11.attr('style', 'width: 100%; display: none;');
        
        el10.removeAttr('style');
        el10.attr('style', 'width: 100%;');
        
        el12.removeAttr('style');
        el12.attr('style', 'width: 100%; display: none;');
    });
    
    $('#2a3').on('click',function(){
        var el11 = $('#chooseAnswer');
        var el12 = $('#chooseAnswer1');
        var el10 = $('#chooseAnswer2');
        
        el11.removeAttr('style');
        el11.attr('style', 'width: 100%; display: none;');
        
        el12.removeAttr('style');
        el12.attr('style', 'width: 100%; display: none;');
        
        el10.removeAttr('style');
        el10.attr('style', 'width: 100%;');
    });

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

    function check_testing(){
        if(document.getElementById('submit_test').innerHTML == "NỘP BÀI"){
            removePTimer();
            
            // disable all radio buttons AND set background to result
            for(var j = 0; j < listVocab_result.length; j++){
                var rad = document.forms["radio_form"]["ques0" + j];
                // var rad_td = document.forms["radio_form"]["td_id"];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = true;
                    if(rad[i].value == listVocab_result[j]){
                        rad[i].parentElement.setAttribute("style", "background-color: #99cc33;");
                        // rad_td[i].setAttribute("style", "background-color: green;");
                    }
                }
            }
            for(var j = 0; j < listVocab1_result.length; j++){
                var rad = document.forms["radio_form"]["ques1" + j];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = true;
                    if(rad[i].value == listVocab1_result[j]){
                        rad[i].parentElement.setAttribute("style", "background-color: #99cc33;");
                    }
                }
            }
            for(var j = 0; j < listVocab2_result.length; j++){
                var rad = document.forms["radio_form"]["ques2" + j];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = true;
                    if(rad[i].value == listVocab2_result[j]){
                        rad[i].parentElement.setAttribute("style", "background-color: #99cc33;");
                    }
                }
            }
            
            // calculating...
            var correct_answer = 0;
            
            // change background color for radio button
            for(var j = 0; j < listVocab_result.length; j++){
                var rad = document.forms["radio_form"]["ques0" + j];
    
                for(var i = 0; i < rad.length; i++) {
                    // console.log("j= " + j + ", " + "i= " + i + ", " + rad[i].value + ", " + listVocab_result[j] + ", " + rad[i].checked);
                    if(rad[i].value == listVocab_result[j] && rad[i].checked == true){
                        correct_answer += 1;
                    } else if(rad[i].value != listVocab_result[j] && rad[i].checked == true){
                        rad[i].parentElement.setAttribute("style", "background-color: #cc0000;");
                    }
                }
            }
            for(var j = 0; j < listVocab1_result.length; j++){
                var rad = document.forms["radio_form"]["ques1" + j];
    
                for(var i = 0; i < rad.length; i++) {
                    if(rad[i].value == listVocab1_result[j] && rad[i].checked == true){
                        correct_answer += 1;
                    } else if(rad[i].value != listVocab1_result[j] && rad[i].checked == true){
                        rad[i].parentElement.setAttribute("style", "background-color: #cc0000;");
                    }
                }
            }
            for(var j = 0; j < listVocab2_result.length; j++){
                var rad = document.forms["radio_form"]["ques2" + j];
    
                for(var i = 0; i < rad.length; i++) {
                    if(rad[i].value == listVocab2_result[j] && rad[i].checked == true){
                        correct_answer += 1;
                    } else if(rad[i].value != listVocab2_result[j] && rad[i].checked == true){
                        rad[i].parentElement.setAttribute("style", "background-color: #cc0000;");
                    }
                }
            }
            
            document.getElementById('title_answer').innerHTML = "Kết quả thi";
            document.getElementById('correct_answer').innerHTML = correct_answer + " / " + (countQuestion);
            document.getElementById('submit_test').innerHTML = "LÀM LẠI";
        } else {
            removePTimer();
            timeCounter(countQuestion / 2);
            
            // enable all radio buttons AND remove style of result
            for(var j = 0; j < listVocab_result.length; j++){
                var rad = document.forms["radio_form"]["ques0" + j];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = false;
                    rad[i].checked = false;
                    rad[i].parentElement.removeAttribute("style");
                }
            }
            for(var j = 0; j < listVocab_result.length; j++){
                var rad = document.forms["radio_form"]["ques1" + j];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = false;
                    rad[i].checked = false;
                    rad[i].parentElement.removeAttribute("style");
                }
            }
            for(var j = 0; j < listVocab_result.length; j++){
                var rad = document.forms["radio_form"]["ques2" + j];
                
                for(var i = 0; i < rad.length; i++) {
                    rad[i].disabled = false;
                    rad[i].checked = false;
                    rad[i].parentElement.removeAttribute("style");
                }
            }
            
            document.getElementById('title_answer').innerHTML = "Phần trả lời";
            document.getElementById('correct_answer').innerHTML = "";
            document.getElementById('submit_test').innerHTML = "NỘP BÀI";
        }
        
    };
 </script>