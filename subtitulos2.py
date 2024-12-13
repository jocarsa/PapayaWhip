from pytubefix import YouTube, Playlist
import os
import json
from datetime import datetime

urls = [
    'https://www.youtube.com/watch?v=1pky5c5XObc&list=PLWKjZdWQCDC6VGuHrdWcHSH8fLk2jsOOg',
    'https://www.youtube.com/watch?v=JUzCUvx31Aw&list=PLWKjZdWQCDC7iphKGis62vqyD78ASQPCK',
    'https://www.youtube.com/watch?v=tmzzEPUikZ0&list=PLWKjZdWQCDC7GjAjoVuk8MK4w47jSZjOB',
    'https://www.youtube.com/watch?v=RPXSYVFEHhM&list=PLWKjZdWQCDC5mFLhi4WLCHch91fzYxmPQ',
    'https://www.youtube.com/watch?v=HscK00_Kzn4&list=PLWKjZdWQCDC7XK59_7oKPZlz06SrP-I52',
    'https://www.youtube.com/watch?v=8qIye-l7z7o&list=PLWKjZdWQCDC4ECqxdOoUG1H5ZvXH4A8Oz',
    'https://www.youtube.com/watch?v=lDVH2sVbBrs&list=PLWKjZdWQCDC6o-_Ev4OKCPd4_rUTa9xNy',
    'https://www.youtube.com/watch?v=Uge5gAd9S9s&list=PLWKjZdWQCDC4Lre7UCp2ZdYLtcjJgWZ9d',
    'https://www.youtube.com/watch?v=ESQbWn0sidk&list=PLWKjZdWQCDC7w8tH-3u4vl7oAU7i1CKuK',
    'https://www.youtube.com/watch?v=X_dphfcfkPQ&list=PLWKjZdWQCDC5o1l52VPBtkDtvKLBL_pfP',
    'https://www.youtube.com/watch?v=xkWY2KXuFFU&list=PLWKjZdWQCDC64r_NqiXefU-gOWQPdgr6T'
]

output_data = {}

for url in urls:
    try:
        pl = Playlist(url)
        playlist_name = pl.title
        print("Nombre de la playlist:", playlist_name)

        # Crear carpeta para la playlist
        if not os.path.exists(playlist_name):
            os.makedirs(playlist_name)
            print(f"Carpeta creada: {playlist_name}")
        else:
            print(f"Carpeta ya existe: {playlist_name}")

        playlist_data = []
        for video in pl.videos:
            try:
                print("Procesando video:", video.title)
                yt = video

                # Obtener subtítulos disponibles
                available_captions = yt.captions
                print("Subtítulos disponibles:", available_captions)

                if 'a.es' in available_captions:
                    caption = yt.captions['a.es']
                    subtitle_text = caption.generate_srt_captions()

                    # Limpiar el texto de subtítulos
                    plain_text = ' '.join([line for line in subtitle_text.splitlines() if '-->' not in line and not line.isdigit()])

                    # Crear el archivo de transcripción
                    video_title = yt.title.replace(" ", "_").replace("/", "_")
                    filename = os.path.join(playlist_name, f"{video_title}.txt")

                    if not os.path.exists(filename):
                        with open(filename, "w", encoding="utf-8") as file:
                            file.write(plain_text)
                        print(f"Archivo creado: {filename}")
                    else:
                        print(f"Archivo ya existe: {filename}")

                    # Agregar información al JSON
                    playlist_data.append({
                        "video_title": yt.title,
                        "txt_file_name": f"{video_title}.txt",
                        "txt_file_path": filename,
                        "video_url": yt.watch_url,
                        "recorded_at": str(datetime.now())
                    })
                else:
                    print(f"Subtítulos en español no disponibles para: {yt.title}")

            except Exception as e:
                print(f"Error procesando el video {video.title}: {e}")

        # Guardar información de la playlist
        output_data[playlist_name] = playlist_data

    except Exception as e:
        print(f"Error procesando la playlist: {e}")

# Guardar el archivo JSON
with open("playlists_data.json", "w", encoding="utf-8") as json_file:
    json.dump(output_data, json_file, indent=4, ensure_ascii=False)

print("Proceso completado. Archivo JSON generado: playlists_data.json")
