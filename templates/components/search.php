<div class="search-wrapper">
    <div class="input-holder">
        <input type="text" class="search-input" placeholder="Type to search" onkeypress="
            <?php echo isset($fun)?$fun:'';?>(this.value)"
            />
        <button class="search-icon" onclick="(()=>{searchToggle(this, event);<?php  echo isset($fun)?$fun:'';?>(this.parentNode.firstChild.value);})()">
            <span></span>
        </button>
    </div>
    <span class="close" onclick="searchToggle(this, event);"></span>
</div>