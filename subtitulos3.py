from pytubefix import YouTube, Playlist
import os
import json
from datetime import datetime
import requests


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
# Root folders for subtitles and thumbnails
subtitles_root = "subtitulos"
thumbnails_root = "miniaturas"

# Ensure root folders exist
os.makedirs(subtitles_root, exist_ok=True)
os.makedirs(thumbnails_root, exist_ok=True)

output_data = {}

for url in urls:
    try:
        pl = Playlist(url)
        playlist_name = pl.title.replace(" ", "_").replace("/", "_")
        print("Nombre de la playlist:", playlist_name)

        # Create subfolders for this playlist
        playlist_subtitles_folder = os.path.join(subtitles_root, playlist_name)
        playlist_thumbnails_folder = os.path.join(thumbnails_root, playlist_name)
        os.makedirs(playlist_subtitles_folder, exist_ok=True)
        os.makedirs(playlist_thumbnails_folder, exist_ok=True)

        playlist_data = []

        for video in pl.videos:
            try:
                print("Procesando video:", video.title)
                yt = video

                # Format video title for safe file naming
                video_title = yt.title.replace(" ", "_").replace("/", "_")

                # Subtitle handling
                subtitles_file = os.path.join(playlist_subtitles_folder, f"{video_title}.txt")
                if 'a.es' in yt.captions:
                    caption = yt.captions['a.es']
                    subtitle_text = caption.generate_srt_captions()

                    # Clean the subtitle text
                    plain_text = ' '.join([line for line in subtitle_text.splitlines() if '-->' not in line and not line.isdigit()])

                    if not os.path.exists(subtitles_file):
                        with open(subtitles_file, "w", encoding="utf-8") as file:
                            file.write(plain_text)
                        print(f"Subtítulo guardado: {subtitles_file}")
                    else:
                        print(f"Subtítulo ya existe: {subtitles_file}")
                else:
                    subtitles_file = None
                    print(f"Subtítulos en español no disponibles para: {yt.title}")

                # Thumbnail handling
                thumbnail_url = yt.thumbnail_url
                thumbnail_file = os.path.join(playlist_thumbnails_folder, f"{video_title}.jpg")
                if not os.path.exists(thumbnail_file):
                    response = requests.get(thumbnail_url)
                    with open(thumbnail_file, "wb") as file:
                        file.write(response.content)
                    print(f"Miniatura descargada: {thumbnail_file}")
                else:
                    print(f"Miniatura ya existe: {thumbnail_file}")

                # Add video data to playlist
                playlist_data.append({
                    "video_title": yt.title,
                    "txt_file_path": subtitles_file,
                    "thumbnail_file_path": thumbnail_file,
                    "video_url": yt.watch_url,
                    "recorded_at": str(datetime.now())
                })

            except Exception as e:
                print(f"Error procesando el video {video.title}: {e}")

        # Save playlist data
        output_data[playlist_name] = playlist_data

    except Exception as e:
        print(f"Error procesando la playlist: {e}")

# Save JSON file
with open("playlists_data.json", "w", encoding="utf-8") as json_file:
    json.dump(output_data, json_file, indent=4, ensure_ascii=False)

print("Proceso completado. Archivo JSON actualizado: playlists_data.json")
