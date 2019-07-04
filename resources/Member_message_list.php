  <link rel="stylesheet" type="text/css" href="__CSS2__/jibenxinxi.css">
    <link rel="stylesheet" type="text/css" href="__CSS2__/member.css">
    <div class="userbasic_head">
        <a href="">网站公告</a>
     
        <a href="" class="active">站内消息</a>
    </div>
    <div class="userbasic_body">
        <div class="bank_tips">温馨提示：</div>
        <div class="table_top">
            <table cellspacing="0" cellpadding="0">
                <thead>
                <th style="width: 20%">时间</th>
                <th style="width: 30%">标题</th>
                <th>内容</th>
                 </thead>
                <tbody>
                </tbody>
            </table>
            <div class="tcdPageCode"></div>
        </div>
    </div>
    <div class="loading_shadow hide">
      <div class="shadow"></div>
      <img src="" class="loading_win">
    </div>
    <script type="text/javascript">
    var initPage=false;  //初始状态
    var tbodyHtml='';  //tbody tag

    var getList = function (filter) {
     $('.loading_shadow').show();
     $.ajax({  
        type : 'GET',
        url : "{{ route('member.messageList') }}?page="+filter.page,
        success : function(data){
            console.log(data);
        $('.loading_shadow').hide();
        var data=data;
         var totalPage=Math.ceil(data.total/data.per_page);
         var currentPage=data.current_page;

         tbodyHtml='';

          for(var i=0;i<data.data.length;i++){
                  href= data.data[i].url?data.data[i].url:'javascript:;';
            tbodyHtml+='<tr>';
            tbodyHtml+='   <td>'+data.data[i].created_at+'</td>';
            tbodyHtml+='   <td><a href="'+href+'" target="_blank">'+data.data[i].title+'</a></td>';
            tbodyHtml+='   <td>'+data.data[i].content+'</td>';
            tbodyHtml+='<tr>';            
          }
         
         $('tbody').html(tbodyHtml);
               
        if (initPage == false) {

          $(".tcdPageCode").createPage({
            pageCount: totalPage,
            current: currentPage,
            backFn: function (p) {
              $('.loading_shadow').show();
              search(p);
            }
          });
          $('.loading_shadow').hide();
          initPage = true;
        } else {

          $(".tcdPageCode").createPage({
            pageCount: totalPage,
            current: filter.page,
            backFn:function(){
              $('.loading_shadow').show();
            }
          });
          $('.loading_shadow').hide();
        }
    }
      })
    };

    var search = function (p,type) {
      var filter = {
        page: p
      }

      getList(filter);
      
    };

    search(1);
    </script>

