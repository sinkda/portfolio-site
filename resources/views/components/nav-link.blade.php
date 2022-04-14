<a  href='{{ $href }}'
    @class([
            'flex text-gray-600 cursor-pointer transition-colors duration-300',
            'hover:text-blue-500' => !$active,
            'text-blue-600 font-semibold' => $active
        ])>
        {{ $slot }}
</a>