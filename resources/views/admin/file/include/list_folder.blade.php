<ul class="popup-folder">
    <li><a href="javascript:;" data-folder="{{$fileConfig}}/" class="select-folder"><i class="fas fa-folder-open" style="color: #FFD969"></i>{{$fileConfig.'/'}}</a></li>
    @if(count($childFolders))
        <ul>
            @foreach($childFolders as $folder)
                <li><a href="javascript:;" data-folder="{{$folder->path.$folder->name."/"}}" class="select-folder"><i class="fas fa-folder" style="color: #FFD969"></i>{{$folder->name}}</a></li>
            @endforeach
        </ul>
    @endif
</ul>

