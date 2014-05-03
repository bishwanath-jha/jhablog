<div class="span8">
            Select Post Feature Image : <input type="file" name=""/>
            <div class="input-prepend">
                <span class="add-on"> Enter Post Title:</span><input type="text" name="post_title" placeholder="Username" size="16" id="prependedInput" class="span2">
            </div>
            <textarea class="ckeditor" name="post_content"></textarea><br/><br/>
            Choose Categories:
            <?php foreach ($categories as $k => $cat) { ?>
                <label class="selectit">
                    <input type="checkbox" name="<?php echo $cat['name']; ?>"> <?php echo $cat['title']; ?> &nbsp;&nbsp;&nbsp;
                </label>
            <?php } ?>
            <br/><br/>
            Choose Tags:
            <?php foreach ($tags as $k => $cat) { ?>
                <label class="selectit">
                    <input type="checkbox" name="<?php echo $cat['name']; ?>"> <?php echo $cat['title']; ?> &nbsp;&nbsp;&nbsp;
                </label>
            <?php } ?>
            <br/><br/>
            <input type="submit" name="save" value="Save Post"/>
            </form>
        </div>
    </div>
</div>