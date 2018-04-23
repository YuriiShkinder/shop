<div class="container">

    <div style="margin-top: 50px" class="row justify-content-center">
        <div class="col-lg-6 ">

            <form action="{{route('admin.styles.update',['style'=>$style->id])}}" method="post">
                <div class="form-group">
                    <label for="header">Style header:</label>
                    <input style="background-color:{{$style->header}} " disabled id="header" class="form-control" type="text"  value="{{$style->header}}">
                </div>

                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select name="header" class="form-control" id="sel1">
                        <option style="background-color:#ffffff ">#ffffff</option>
                        <option style="background-color:#f1d6f3 ">#f1d6f3</option>
                        <option style="background-color:#0769ab ">#0769ab</option>
                        <option style="background-color:#2675d3 ">#2675d3</option>
                        <option style="background-color:#25527f ">#25527f</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="site">style site:</label>
                    <input style="background-color:{{$style->site}} " disabled id="site" class="form-control" type="text" value="{{$style->site}}">
                </div>

                <div class="form-group">
                    <label for="sel1">Select list:</label>
                    <select  name="site" name="header" class="form-control" id="sel1">
                        <option style="background-color:#ffffff ">#ffffff</option>
                        <option style="background-color:#f1d6f3 ">#f1d6f3</option>
                        <option style="background-color:#0769ab ">#0769ab</option>
                        <option style="background-color:#2675d3 ">#2675d3</option>
                        <option style="background-color:#25527f ">#25527f</option>
                    </select>
                </div>

                {{csrf_field()}}

                <input type="hidden" name="_method" value="PUT">
                <button type="submit" class="btn btn-default">Submit</button>
            </form>

        </div>
    </div>

</div>
