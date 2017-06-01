/**
 * Created by chen on 2017/2/13.
 */
var Tablesort=function(){
    return{
        init:function(){
            $.each($('#tablesort tr:first th'),function(){
                var fielname=$(this).text();
                var sortArray=/[姓名时间号码日期]/;
                if(fielname.match(sortArray)){
                    var css={'background-image': 'url(../image/sort_both.png)',
                        'background-position-x': 'right',
                        'background-position-y': 'center',
                        'background-size': 'initial',
                        'background-repeat-x': 'no-repeat',
                        'background-repeat-y': 'no-repeat',
                        'background-attachment': 'initial',
                        'background-origin': 'initial',
                        'background-clip': 'initial',
                        'background-color': 'initial',
                        'cursor':'pointer'
                    };
                    $(this).css(css);
                    $(this).addClass('sortfields');
                }
            });

        }
    }
}();
