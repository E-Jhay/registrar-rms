@forelse ($filtered_documents as $item)
    {{$item->document_type->name}}
@empty
    
@endforelse