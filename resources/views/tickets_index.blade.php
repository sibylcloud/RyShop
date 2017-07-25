@section('title')
    我的订单
@stop
@include('header')
@include('nav')

@if(Auth::user())
    <section class="container grid-960">
        <div class="container">
            <div class="columns">
                <div class="column col-3 col-md-12">
                    @include("sidebar")
                </div>
                <div class="column col-9 col-md-12">
                    <div class="order-item-title">
                        您的工单提问共 <b>{{Auth::user()->ticket()->count()}}</b> 个，其中<b> <?php echo Auth::user()->ticket()->count()-Auth::user()->ticket()->where("valid","=",'0')->count();?></b> 个为有效的
                        <a href="/my_ticket/new" class="new_ticket_btn"> 提交新工单</a>
                    </div>

                        @if(Auth::user()->ticket->count())
                        <div class="ticket-panel">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>时间</th>
                                <th>状态</th>
                                <th>回复情况</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tic as $ticinfo)
                                <tr>
                                    <td><a href="/my_ticket/{{$ticinfo->id}}">{{$ticinfo->title}}</a></td>
                                    <td><?php echo $ticinfo->updated_at->toDateString();?></td>
                                    <td>
                                        @if($ticinfo->valid=="1")
                                            <div class="inline" style="color: #4CAF50">有效</div>
                                        @else
                                            <div class="inline" style="color: #607D8B">已关闭</div>
                                        @endif
                                    </td>
                                    <td style="text-align: center">
                                        @if($ticinfo->reply==Auth::user()->id)
                                            <div class="inline" style="color: #607D8B;">尚未</div>
                                        @else
                                            <div class="inline" style="color: #4CAF50;">√</div>
                                        @endif

                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                        </div>
                        @endif
                        <div class="host-tips toast" @if(Auth::user()->ticket->count()) style="margin-top:10px;" @endif>
                            温馨提示：若您在使用我们的主机产品过程中，有任何的疑问或者需要提供有关于我们产品的帮助，
                            您可以发送工单并详细描述您的问题，管理员将会在24小时内作出回复。若您的问题在我们答复之后已经
                            得到解决，您可以自行关闭工单，或一段时间无提问后管理员也会将其关闭。祝您使用愉快！
                        </div>

                </div>

            </div>
        </div>
    </section>
@else
    <section class="container grid-960">
        <div class="card user-info">
            <div class="empty">
                <div class="empty-icon">
                    <i class="icon icon-people"></i>
                </div>
                <h4 class="empty-title">您还没有登录</h4>
                <p class="empty-subtitle">您还没有登录系统，请登录之后再进行操作哦！</p>
                <div class="empty-action">
                    <a href="/auth/login" class="btn btn-primary">登录</a>
                    <a href="/auth/resigter" class="btn">注册</a>
                </div>
            </div>
        </div>
    </section>

@endif
@include('footer')