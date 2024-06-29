@if ($active)
    <div class="toastku border-{{ $type }}">
        <div class="toast-content">
            <i class="fas fa-solid fa-check check bg-{{ $type }}"></i>
            <div class="message">
                <span class="text text-1">{{ $header }}</span>
                <span class="text text-2">

                    @if (is_string($message))
                        {{ $message }}
                    
                    @elseif(is_array($message))
                        <ul>
                            @foreach ($message as $item)
                            <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    @endif
                </span>
            </div>
        </div>
        <i class="fa-solid fa-xmark close"></i>
        <div class="progress {{ $type }}"></div>
    </div>
@endif