@extends('layouts.layout')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Profile Picture Card --}}
        <div class="card">
            <div class="card-header">Cooperative Logo</div>
            <div class="card-body text-center">
                <img src="{{ $user->profile_picture ? asset('shared/uploads/' . $user->profile_picture) : asset('images/default.png') }}"
                    class="rounded-circle" width="150" height="150" alt="Profile Picture">
                <br><br>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProfilePicModal">Edit
                    Picture</button>
            </div>
        </div>
    </div>

    {{-- Modal: Edit Profile Picture --}}
    <div class="modal fade" id="editProfilePicModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Cooperative Logo</h5>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="profile_picture" accept="image/png, image/jpeg" class="form-control"
                            required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
