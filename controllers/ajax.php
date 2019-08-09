<?php

class ajax extends Controller
{
    function video_intro(){
        echo @'<iframe width="100%" height="585" src="https://www.youtube.com/embed/f2KU-EuYJPU?list=PL5etz2vi6be8KQ8RhZDANSvTMgwXKhlfg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
    }
}