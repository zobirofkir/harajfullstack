<x-app-layout title="تسجيل الدخول">

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-lg">
            <strong class="font-semibold">{{ session('success') }}</strong>
        </div>
    @endif

    @if (session('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-lg">
            <strong class="font-semibold">{{ session('message') }}</strong>
        </div>
    @endif

    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-center text-3xl font-extrabold text-gray-900 mb-6">
                تسجيل الدخول
            </h2>

            <div class="mt-6 text-center">
                <button id="googleSignIn" class="w-full py-2 px-4 bg-blue-600 text-white rounded-md hover:bg-blue-500 flex items-center justify-center gap-4 space-x-2 transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fab fa-google"></i>
                    <span >تسجيل الدخول باستخدام جوجل</span>
                </button>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="login" class="block text-sm font-medium text-gray-700">
                        البريد الإلكتروني أو اسم المستخدم
                    </label>
                    <input id="login" name="login" type="text" required autofocus
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                           placeholder="أدخل البريد الإلكتروني أو اسم المستخدم" value="{{ old('login') }}">
                    @error('login')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">كلمة المرور</label>
                    <input id="password" name="password" type="password" required
                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-500 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                           placeholder="كلمة المرور">
                    @error('password')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-300 ease-in-out transform hover:scale-105">
                        تسجيل الدخول
                    </button>
                </div>
                @if (session('error'))
                    <p class="text-red-500 text-sm mt-4 text-center">{{ session('error') }}</p>
                @endif
            </form>

            <!-- روابط التسجيل واستعادة كلمة المرور -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 mt-4">
                    ليس لديك حساب؟
                    <a href="{{ route('register') }}" class="text-gray-800 font-medium hover:underline">
                        إنشاء حساب جديد
                    </a>
                </p>
                <p class="text-sm text-gray-600 mt-4">
                    نسيت كلمة المرور؟
                    <a href="{{ route('forgot-password') }}" class="text-gray-800 font-medium hover:underline">
                        استعادة كلمة المرور
                    </a>
                </p>
            </div>

        </div>
    </div>

    <!-- Load Firebase compat libraries -->
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.22.2/firebase-auth-compat.js"></script>

    <script>
        const firebaseConfig = {
            apiKey: "AIzaSyADP6b_PkkkF-4UrO6fpbux7SionpKgyYM",
            authDomain: "deenalisa.firebaseapp.com",
            projectId: "deenalisa",
            storageBucket: "deenalisa.firebasestorage.app",
            messagingSenderId: "259499355304",
            appId: "1:259499355304:web:bc2efe9cb52d0e1a4ce69d",
            measurementId: "G-NBCY3X2E62"
        };

        const app = firebase.initializeApp(firebaseConfig);
        const auth = firebase.auth();

        document.addEventListener('DOMContentLoaded', () => {
            const googleSignInBtn = document.getElementById('googleSignIn');
            if (googleSignInBtn) {
                googleSignInBtn.addEventListener('click', function () {
                    const provider = new firebase.auth.GoogleAuthProvider();
                    firebase.auth().signInWithPopup(provider)
                        .then((result) => {
                            result.user.getIdToken().then((idToken) => {
                                fetch("{{ route('firebase.login') }}", {
                                    method: "POST",
                                    headers: {
                                        "Content-Type": "application/json",
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    body: JSON.stringify({ idToken: idToken })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if(data.success) {
                                        window.location.href = "{{ route('home') }}";
                                    } else {
                                        alert("Login failed!");
                                    }
                                })
                                .catch(error => {
                                    console.error("Error:", error);
                                });
                            });
                        })
                        .catch((error) => {
                            console.error("Error during Google Sign In:", error);
                        });
                });
            }
        });
    </script>
</x-app-layout>
