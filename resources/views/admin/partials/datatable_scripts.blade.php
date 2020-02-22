<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables/dataTables.scroller.min.js')}}"></script>
@if(App::getLocale() == 'ar')
    <script src="{{asset('admin/pages/datatables.init_ar.js')}}"></script>
@else
    <script src="{{asset('admin/pages/datatables.init.js')}}"></script>
@endif