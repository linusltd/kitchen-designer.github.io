@push('scripts')
    <script>
        $(document).ready(function(){

            $('#review').click(function(){
                $('#tab-review').attr('class','tab')
                $('#review').attr('class','tab-link tab-active')

                $('#tab-description').attr('class', 'tab d-none')
                $('#description').attr('class','tab-link')
                console.log(`Happening`)
            });

            $('#description').click(function(){
                $('#tab-review').attr('class','tab d-none')
                $('#review').attr('class','tab-link')

                $('#tab-description').attr('class', 'tab')
                $('#description').attr('class','tab-link tab-active')
            });


        })
    </script>
@endpush
