<!-- PurchaseModal -->
<div class="purchase modal fade" id="purchaseModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <i class="bi bi-x-lg" type="button" class="btn-close" data-bs-dismiss="modal"></i>
            </div>
            <div class="modal-body text-center">
                <h1 style="font-size: 25px; font-weight: 600; margin-bottom: 20px;">Tack för din beställning!</h1>
                <p>Vi kommer granska beställningen och leverera enligt önskad tid.</p>
                <a href="{{ url('/') }}" class="btn btn-success mt-3">Tillbaka till startsidan</a>
            </div>
        </div>
    </div>
</div>
