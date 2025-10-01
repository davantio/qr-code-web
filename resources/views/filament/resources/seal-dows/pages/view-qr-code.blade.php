<x-filament-panels::page>
    {{-- Page content --}}

    <div class="space-y-2">
        <div class="text-sm font-medium">QR Code</div>
        <br>
        <div class="flex justify-center p-4 bg-white rounded-lg">
            <div id="qrcode-simple">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate(url('/?c=' . $this->getRecord()->code)) !!}
            </div>
        </div>
        <div class="flex justify-center mt-2">
            <button onclick="downloadQRCode('qrcode-simple', 'qrcode-{{ $this->getRecord()->code }}')" 
                class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                Download QR Code
            </button>
        </div>
    </div>

    {{-- @php
        $record = $this->getRecord();
        // Buat URL lengkap untuk QR Code JSON
        $qrUrl = url('/?c=' . $record->code);
    @endphp --}}

    {{-- <div class="space-y-2">
        <div class="text-sm font-medium">QR Code (Product URL)</div>
        <div class="flex justify-center p-4 bg-white rounded-lg">
            <div id="qrcode-json">
                {!! SimpleSoftwareIO\QrCode\Facades\QrCode::size(200)->generate($qrUrl) !!}
            </div>
        </div>
        <div class="flex justify-center mt-2">
            <button onclick="downloadQRCode('qrcode-json', 'qrcode-{{ $record->code }}')" 
                class="px-4 py-2 text-sm font-medium text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                Download QR Code URL
            </button>
        </div>
    </div> --}}

    <script>
        function downloadQRCode(elementId, filename) {
            const qrElement = document.getElementById(elementId);
            const svg = qrElement.querySelector('svg');
            
            if (svg) {
                // Convert SVG to canvas
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const svgData = new XMLSerializer().serializeToString(svg);
                const img = new Image();
                
                canvas.width = svg.width.baseVal.value;
                canvas.height = svg.height.baseVal.value;
                
                img.onload = function() {
                    ctx.fillStyle = 'white';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(img, 0, 0);
                    
                    // Download as PNG
                    const link = document.createElement('a');
                    link.download = filename + '.png';
                    link.href = canvas.toDataURL('image/png');
                    link.click();
                };
                
                img.src = 'data:image/svg+xml;base64,' + btoa(unescape(encodeURIComponent(svgData)));
            }
        }
    </script>
</x-filament-panels::page>