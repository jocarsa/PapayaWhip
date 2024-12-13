from pytubefix import YouTube,Playlist
from pytubefix.cli import on_progress
import os

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
for url in urls:
    pl = Playlist(url)
    playlist_name = pl.title
    print("Nombre de la playlist:", playlist_name)
    if not os.path.exists(playlist_name):
        os.makedirs(playlist_name)
        print(f"Folder created: {playlist_name}")
    else:
        print(f"Folder already exists: {playlist_name}")
    for video in pl.videos:
        try:
            print(video)      
            yt = YouTube('http://youtube.com/watch?v=ESQbWn0sidk')
            yt = video
            available_captions = yt.captions
            print("Available captions:", available_captions)
            if 'a.es' in available_captions:
                caption = yt.captions['a.es']  
                subtitle_text = caption.generate_srt_captions()
                plain_text = ' '.join([line for line in subtitle_text.splitlines() if '-->' not in line and line.isdigit() == False])
                video_title = yt.title.replace(" ", "_")
                filename = f"{playlist_name}/{video_title}.txt"
                with open(filename, "a", encoding="utf-8") as file:
                    file.write(plain_text)            
            else:
                print("English subtitles are not available.")
        except  Exception as e:
            print(e)
