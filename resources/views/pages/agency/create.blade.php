<div class="row collapse" id="collapsable" >
    <div class="col-lg-12">
        <div class="card-box">
            <center> 
                <h3 class=" m-t-0 m-b-30" id="agencyTitle">ثبت نمایندگی جدید</h3>
            </center>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-12 col-sm-12 col-md-10 col-lg-8" >
                    <form id="agencyForm" >
                        @csrf
                        <input type="hidden" id="agency_id" name="agency_id">
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="name">اسم نمایندگی</label>
                            <input type="text" name="name" parsley-trigger="change" required
                                placeholder="اسم نمایندگی جدید را وارد کنید" class="form-control" id="name">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="owner">مسئول نمایندگی</label>
                            <input id="owner" type="text" type="text" name="owner" parsley-trigger="change" required
                                placeholder="اسم مسئول نمایندگی را وارد کنید" class="form-control" id="owner">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="phone_number">شماره تماس</label>
                            <input id="phone_number" type="tel" name="phone_number" type="tel" placeholder="شماره تماس نمایندگی" required
                                class="form-control">
                        </div>
                        <div class="form-group  col-md-6 col-lg-6 col-xl-6 ">
                            <label for="address">آدرس نمایندگی </label>
                            <input id="address" type="text" name="address" parsley-trigger="change" required
                                placeholder="آدرس نمایندگی را وارد کنید" class="form-control" id="address">
                        </div>
                        <div class="row col-lg-12 mt-5">
                            <div class="form-group mt-5">
                                <div class="form-group  col-md-6 col-lg-6 col-xl-6">
                                    <select type="button" name="status" id="status" class="btn btn-default form-control dropdown-toggle">
                                        <option selected disabled>وضعیت نمایندگی را انتخاب کنید</option>
                                        <option value="1">فعال</option>
                                        <option value="0">غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-right " style="margin-left:10px !important">
                            <button id="saveOrUpdate" class="btn btn-primary btn-rounded waves-effect waves-light" >
                                ثبت
                            </button>              
                            <button type="reset" data-toggle="collapse" data-target="#collapsable"  class="btn-danger btn-rounded btn btn-default waves-effect waves-light">
                                بستن
                            </button>
                        </div>
    
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
