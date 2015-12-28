@extends('layout')

@section('header')
    @include('partials.header-home')
@endsection

@section('menu-main')
    @include('partials.menu-main')
@endsection

@section('menu-header')
    @include('partials.menu-header')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- Horizontal form -->
            <div class="panel panel-flat border-top-primary">
                <div class="wrapper no-pad" >
                    <!--mail inbox start-->
                    <div class="mail-box">
                        <aside class="sm-side">
                            <div class="m-title">
                                <h3>Inbox</h3>
                                <span>14 unread mail</span>
                            </div>
                            <div class="inbox-body">
                                <a class="btn btn-compose" href="inbox-compose.html">
                                    Compose
                                </a>
                            </div>
                            <ul class="inbox-nav inbox-divider">
                                <li class="active">
                                    <a href="#"><i class="icon-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-envelope"></i> Sent Mail</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-briefcase"></i> Important</a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-star-empty3"></i> Starred </a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-new-tab"></i> Drafts <span class="label label-info pull-right">30</span></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon-trash"></i> Trash</a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-stacked labels-info inbox-divider">
                                <li> <h4>Labels</h4> </li>
                                <li> <a href="#"> <i class=" fa fa-sign-blank text-danger"></i> Work </a> </li>
                                <li> <a href="#"> <i class=" fa fa-sign-blank text-success"></i> Design </a> </li>
                                <li> <a href="#"> <i class=" fa fa-sign-blank text-info "></i> Family </a>
                                <li> <a href="#"> <i class=" fa fa-sign-blank text-warning "></i> Friends </a>
                                <li> <a href="#"> <i class=" fa fa-sign-blank text-primary "></i> Office </a>
                                </li>
                            </ul>
                            <ul class="nav nav-pills nav-stacked labels-info inbox-divider ">
                                <li> <h4>Buddy online</h4> </li>
                                <li> <a href="#"> <i class="icon-circle2 text-success"></i> Jhone Doe <p>I do not think</p></a>  </li>
                                <li> <a href="#"> <i class="icon-circle2 text-danger"></i> Sumon <p>Busy with coding</p></a> </li>
                                <li> <a href="#"> <i class="icon-circle2 text-muted "></i> Anjelina Joli <p>I out of control</p></a>
                                <li> <a href="#"> <i class="icon-circle2 text-muted "></i> Jonathan Smith <p>I am not here</p></a>
                                <li> <a href="#"> <i class="icon-circle2 text-muted "></i> Tawseef <p>I do not think</p></a>
                                </li>
                            </ul>
                            <div class="inbox-body text-center">
                                <div class="btn-group">
                                    <a href="javascript:;" class="btn btn-default">
                                        <i class="icon-switch"></i>
                                    </a>
                                    <a href="javascript:;" class="btn btn-default">
                                        <i class="icon-cog3"></i>
                                    </a>
                                </div>
                            </div>
                        </aside>
                        <aside class="lg-side" style="height: 1200px">
                            <div class="inbox-head">
                                <div class="mail-option">
                                    <div class="btn-group">
                                        <a class="btn mini tooltips" href="#" data-toggle="dropdown" data-placement="top" data-original-title="Refresh">
                                            <i class=" icon-loop3"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" href="#">
                                            <i class="icon-archive"></i>
                                        </a>
                                        <a class="btn" href="#">
                                            <i class="icon-info22"></i>
                                        </a>
                                        <a class="btn" href="#">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn" href="#">
                                            <i class="icon-folder2"></i>
                                        </a>
                                        <a class="btn" href="#">
                                            <i class="icon-price-tag2"></i>
                                        </a>
                                    </div>
                                    <div class="btn-group hidden-phone">
                                        <a class="btn mini blue" href="#" data-toggle="dropdown">
                                            More
                                            <i class="icon-arrow-down32 "></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#"><i class="icon-pencil"></i> Mark as Read</a></li>
                                            <li><a href="#"><i class="icon-ban"></i> Spam</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#"><i class="icon-trash"></i> Delete</a></li>
                                        </ul>
                                    </div>
                                    <ul class="unstyled inbox-pagination">
                                        <li><span>1-50 of 2045</span></li>
                                        <li>
                                            <a href="#" class="np-btn"><i class="icon-arrow-left12"></i></a>
                                        </li>
                                        <li>
                                            <a href="#" class="np-btn"><i class="icon-arrow-right13"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="inbox-body no-pad">
                                <table class="table table-inbox table-hover">
                                    <tbody>
                                    <tr class="unread">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message  dont-show">Vector Lab</td>
                                        <td class="view-message ">Lorem ipsum dolor imit set.</td>
                                        <td class="view-message  inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message  text-right">9:27 AM</td>
                                    </tr>
                                    <tr class="unread">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img2.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek Hossain</td>
                                        <td class="view-message">Hi Bro, How are you?</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">March 15</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <span class="bg-success">D</span>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Dulal khan</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">June 15</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">April 01</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <span class="bg-primary">M</span>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek <span class="label label-danger pull-right">urgent</span></td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">May 23</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img2.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">March 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <span class="bg-warning">R</span>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Rafiq</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">January 19</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook <span class="label label-success pull-right">megazine</span></td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">March 04</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek</td>
                                        <td class="view-message view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">June 13</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook <span class="label label-info pull-right">family</span></td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">March 24</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">March 09</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img2.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="dont-show">Facebook</td>
                                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">May 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img3.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Sumon</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">February 25</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="dont-show">Facebook</td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">March 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Dulal</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">April 07</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Twitter</td>
                                        <td class="view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">July 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img3.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Sumon</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">August 10</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img2.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">April 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">June 16</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img3.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Sumon</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">August 10</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">April 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img2.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">April 14</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img1.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Mosaddek</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">June 16</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3 text-primary"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img3.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Sumon</td>
                                        <td class="view-message">Lorem ipsum dolor sit amet</td>
                                        <td class="view-message inbox-small-cells"></td>
                                        <td class="view-message text-right">August 10</td>
                                    </tr>
                                    <tr class="">
                                        <td class="inbox-small-cells">
                                            <label class="chek_inbox">
                                                <input type="checkbox" class="styled">
                                            </label>
                                        </td>
                                        <td class="inbox-small-cells"><i class="icon-star-empty3"></i></td>
                                        <td>
                                            <a href="#" class="avatar">
                                                <img src="images/img4.jpg" alt=""/>
                                            </a>
                                        </td>
                                        <td class="view-message dont-show">Facebook</td>
                                        <td class="view-message view-message">Dolor sit amet, consectetuer adipiscing</td>
                                        <td class="view-message inbox-small-cells"><i class="icon-attachment2"></i></td>
                                        <td class="view-message text-right">April 14</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </aside>
                    </div>
                    <!--mail inbox end-->
                </div>
            </div>
            <!-- /horizotal form -->
        </div>
    </div>
@endsection