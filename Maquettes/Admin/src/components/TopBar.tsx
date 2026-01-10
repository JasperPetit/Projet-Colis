import { useState } from "react";
import { UserCircle } from "lucide-react";
import { LoginModal } from "./LoginModal";
import { Button } from "./ui/button";

export function TopBar() {
  const [isLoginOpen, setIsLoginOpen] = useState(false);

  return (
    <>
      <div className="bg-white border-b border-border px-8 py-4">
        <div className="flex items-center justify-end">
          <Button
            variant="ghost"
            size="icon"
            onClick={() => setIsLoginOpen(true)}
            className="h-12 w-12 rounded-full hover:bg-secondary"
          >
            <UserCircle className="h-8 w-8 text-primary" />
          </Button>
        </div>
      </div>
      
      <LoginModal open={isLoginOpen} onOpenChange={setIsLoginOpen} />
    </>
  );
}
