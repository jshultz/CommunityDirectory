 <h2>Contact Welcome To Sedona Arizona</h2> 
    <p> 
        It's easy to contact Open Sky Media!</p> 
    <p> 
        Open Sky Media, LLC<br /> 
        106 E Aspen ST<br /> 
        Cottonwood, AZ 86326</p> 
    <p> 
        Our phone number is (209) 241-6892 / Toll Free: (888) 526-9357</p> 
        
        <?php echo form_open('email/send'); ?>
            <fieldset class="span-15" style="margin-left:10px;">
               
                    <legend>
                        Use this simple form to contact us
                    </legend>
                    <br/>
                    <?php
                    $name_data = array('name'=>'name', 'id'=>'name', 'value'=>set_value('name'));
                    $message_data = array('name'=>'comments', 'id'=>'comments', 'value'=>set_value('comments'), 'rows'=>'5', 'class'=>'span-7');
					$subject_data = array('BillingQuestion'=>'Billing Question','CustomerService'=>'Customer Service','RateQuote'=>'Rate Quote');
                    ?>
                    <p>
                        <label for="name">
                            Name: 
                        </label><br/>
                        <?php echo form_input($name_data); ?>
                    </p>
                    <p>
                        <label for="email">
                            Email Address *Required*: 
                        </label><br/>
                        <input type="text" name="email" id="email" value="<?php echo set_value('email');?>">
                    </p>
					<p>
                        <label for="phone">
                            Phone Number: 
                        </label><br/>
                        <input type="text" name="phone" id="phone" value="<?php echo set_value('phone');?>">
                    </p>
					<p>
                        <label for="subject">
                            Subject 
                        </label><br/>
                        <?php echo form_dropdown('subject', $subject_data, 'CustomerService');?>
                    </p>
                
                    <p><label>
                        Comments
                    </label><br/>
					<?php echo form_textarea($message_data); ?></p>
                    <br/>
                    <p>
                        <?php echo form_submit('submit', 'Submit'); ?>
                    </p>
                    <?php echo form_close(); ?>
                    </fieldset>
                    <?php echo validation_errors(); ?>