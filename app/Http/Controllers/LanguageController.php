<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class LanguageController extends Controller
{
    public function setLanguage($lang)
    {
        // Guardar el idioma en la sesión
        session(['locale' => $lang]);

        // Redirigir a la página anterior
        return redirect()->back();
    }

    public function translate(Request $request)
    {
        $request->validate([
            'text' => 'required|string',
        ]);

        // Obtener idioma guardado en la sesión
        $lang = session('locale', 'en');

        // Traducir el texto usando Google Translate
        $translator = new GoogleTranslate();
        $translator->setOptions(['verify' => false]); 
        $translator->setTarget($lang);
        $translatedText = $translator->translate($request->input('text'));

        return response()->json([
            'original' => $request->input('text'),
            'translated' => $translatedText,
            'language' => $lang
        ]);
    }
}
