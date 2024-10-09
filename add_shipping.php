<script type="text/JavaScript" src="js/add_shipping.js"></script>
<div class="container paddingtop">
    <div class="row">
        <div class="col-md-4 formcenter">
            <h2 class="titulo marginbottom">Add Shipping Country</h2>
            <div id="errordiv" class="alert alert-danger">
                <strong id="error" ></strong>
            </div>
            <div class="form-group">
                <input type="text" class="form-control inputcp" placeholder="Country" name="country" id="country" />
            </div>
            <div class="form-group">
                <input type="number" class="form-control inputcp" min="0" step="0.01" name="shipcost" id="shipcost" placeholder="Shipping Price" />
            </div>
            <button id="btnaddshipping" class="btn-lg btn-primary btncp">Save Changes</button>
        </div>
    </div>
</div>